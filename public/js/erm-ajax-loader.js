/**
 * ERM Reusable AJAX Loader & Form Ready Indicator
 * --------------------------------------------------------------------------
 * Otomatis melacak seluruh request jQuery AJAX di halaman & modal terbuka,
 * dengan dukungan scoped watcher, anti-race token, dan button submit guard.
 *
 * Cara pakai di mana saja:
 * 1. Otomatis Global: langsung aktif untuk semua AJAX (kecuali ignoreUrls / ermSilent: true).
 * 2. Otomatis pada Modal tertentu:
 *      <div class="modal" id="modalX" data-erm-loader="true" data-erm-lock-buttons=".btnAction">
 *        ...
 *        <span data-erm-loader-status class="erm-loader-pill is-idle"></span>
 *      </div>
 * 3. Manual Multi-Request Scoped Watcher:
 *      ErmLoader.watch('#modalX', [xhr1, xhr2], { label: 'Memuat data...', overlay: true });
 * 4. Anti Double-Submit Tombol:
 *      ErmLoader.button('#btnSimpan', $.post(...), 'Menyimpan...');
 */
(function (window, $) {
    'use strict';

    if (typeof $ === 'undefined') {
        return;
    }

    const FAILSAFE_MS = 15000;

    // Daftar pola URL polling / background yang diabaikan oleh auto-tracker
    const defaultIgnoreUrls = [
        '/notifikasi/respon-farmasi',
        '/get/antrian',
        '/registrasi/status',
        '/lab/riwayat-hasil/',
        '/poliklinik/estimasi',
        '/pemeriksaan/jumlah',
        '/poliklinik/count/',
        '/ranap/monitoring-pulang',
        '/ranap/kelengkapan-berkas',
        '/ranap/kelengkapan-berkas-batch',
        '/ranap/statistik',
    ];

    const stateMap = new WeakMap();
    const tokenMap = new Map();
    let openingModal = null;
    const globalState = {
        pending: 0,
        errors: 0,
        failsafe: null,
    };

    function getGlobalBar() {
        let bar = document.getElementById('ermGlobalProgressBar');
        if (!bar && document.body) {
            bar = document.createElement('div');
            bar.id = 'ermGlobalProgressBar';
            bar.setAttribute('aria-hidden', 'true');
            document.body.appendChild(bar);
        }
        return bar;
    }

    function getTopVisibleModal() {
        const openModals = $('.modal.show');
        if (!openModals.length) {
            return (openingModal && document.body.contains(openingModal)) ? openingModal : null;
        }
        let topModal = null;
        let maxZ = -1;
        openModals.each(function () {
            const z = parseInt(window.getComputedStyle(this).zIndex, 10) || 1055;
            if (z >= maxZ) {
                maxZ = z;
                topModal = this;
            }
        });
        return topModal;
    }

    function shouldIgnoreRequest(settings) {
        if (!settings) return true;
        if (settings.ermSilent === true) return true;
        const url = String(settings.url || '');
        if (!url) return false;
        return ErmLoader.ignoreUrls.some(function (pattern) {
            if (pattern instanceof RegExp) {
                return pattern.test(url);
            }
            return url.indexOf(pattern) !== -1;
        });
    }

    function getTargetState(el) {
        let st = stateMap.get(el);
        if (!st) {
            st = {
                pending: 0,
                errors: 0,
                label: 'Memuat data...',
                failsafe: null,
                overlayCount: 0,
                lockedButtons: new Map(),
            };
            stateMap.set(el, st);
        }
        return st;
    }

    function ensureModalProgressBar(modalEl) {
        const $modal = $(modalEl);
        const $header = $modal.find('.modal-header').first();
        if (!$header.length) return null;

        if (window.getComputedStyle($header[0]).position === 'static') {
            $header.css('position', 'relative');
        }

        let $bar = $header.children('.erm-modal-progress-bar');
        if (!$bar.length) {
            $bar = $('<div class="erm-modal-progress-bar" aria-hidden="true"></div>');
            $header.append($bar);
        }
        return $bar;
    }

    function ensureOverlay(containerEl) {
        const $container = $(containerEl);
        const $body = $container.hasClass('modal')
            ? $container.find('.modal-body').first()
            : $container;

        if (!$body.length) return null;
        if (window.getComputedStyle($body[0]).position === 'static') {
            $body.css('position', 'relative');
        }

        let $overlay = $body.children('.erm-loader-overlay');
        if (!$overlay.length) {
            $overlay = $(
                '<div class="erm-loader-overlay" aria-live="polite">' +
                    '<div class="erm-loader-overlay-card">' +
                        '<span class="spinner-border spinner-border-sm text-primary" role="status"></span>' +
                        '<span class="erm-loader-overlay-text">Memuat komponen form...</span>' +
                    '</div>' +
                '</div>'
            );
            $body.append($overlay);
        }
        return $overlay;
    }

    function lockTargetButtons(el, selectorOverride) {
        const $el = $(el);
        const selector = selectorOverride || $el.attr('data-erm-lock-buttons');
        if (!selector) return;

        const st = getTargetState(el);
        $el.find(selector).each(function () {
            if (!st.lockedButtons.has(this)) {
                st.lockedButtons.set(this, this.disabled);
                this.disabled = true;
            }
        });
    }

    function unlockTargetButtons(el) {
        const st = getTargetState(el);
        st.lockedButtons.forEach(function (wasDisabled, btn) {
            if (btn && document.body.contains(btn)) {
                btn.disabled = wasDisabled;
            }
        });
        st.lockedButtons.clear();
    }

    function renderTarget(el, forceState, customText) {
        const $el = $(el);
        const st = getTargetState(el);
        const isLoading = st.pending > 0;
        const $bar = ensureModalProgressBar(el);
        const $statusEls = $el.find('[data-erm-loader-status]');

        if ($bar) {
            $bar.toggleClass('is-active', isLoading);
        }

        if (isLoading) {
            lockTargetButtons(el);
            const label = customText || st.label || 'Memuat data...';
            const countText = st.pending > 1 ? ` (${st.pending})` : '';
            $statusEls
                .removeClass('is-idle is-ready is-error d-none')
                .addClass('is-loading')
                .html(`<span class="spinner-border spinner-border-sm" role="status"></span><span>${label}${countText}</span>`);
            $el.attr('data-erm-loading', 'true');
            return;
        }

        // Tunggu 1 frame paint browser agar seluruh .val() / .html() selesai dirender di DOM
        window.requestAnimationFrame(function () {
            if (st.pending > 0) return;

            unlockTargetButtons(el);
            $el.removeAttr('data-erm-loading');

            const $overlay = $el.find('.erm-loader-overlay');
            if ($overlay.length && st.overlayCount === 0) {
                $overlay.removeClass('is-active');
            }

            if (forceState === 'idle') {
                $statusEls
                    .removeClass('is-loading is-ready is-error')
                    .addClass('is-idle')
                    .html('<i class="bi bi-check2-circle"></i><span>Siap</span>');
                return;
            }

            if (st.errors > 0 || forceState === 'error') {
                $statusEls
                    .removeClass('is-idle is-loading is-ready d-none')
                    .addClass('is-error')
                    .html(`<i class="bi bi-exclamation-triangle-fill"></i><span>${customText || 'Sebagian data gagal dimuat'}</span>`);
            } else {
                $statusEls
                    .removeClass('is-idle is-loading is-error d-none')
                    .addClass('is-ready')
                    .html(`<i class="bi bi-check-circle-fill"></i><span>${customText || 'Data Siap'}</span>`);
            }

            $el.trigger('erm:loaded', [{ errors: st.errors }]);
        });
    }

    function renderGlobal() {
        const bar = getGlobalBar();
        if (!bar) return;
        bar.classList.toggle('is-active', globalState.pending > 0);
    }

    function startOnTarget(el, label, options) {
        const st = getTargetState(el);
        if (st.pending === 0) {
            st.errors = 0;
        }
        st.pending++;
        if (label) {
            st.label = label;
        }

        if (options && options.lockButtons) {
            lockTargetButtons(el, options.lockButtons);
        }

        if (options && options.overlay) {
            st.overlayCount++;
            const $overlay = ensureOverlay(el);
            if ($overlay) {
                $overlay.find('.erm-loader-overlay-text').text(label || 'Memuat komponen form...');
                $overlay.addClass('is-active');
            }
        }

        clearTimeout(st.failsafe);
        st.failsafe = setTimeout(function () {
            ErmLoader.reset(el);
        }, FAILSAFE_MS);

        renderTarget(el);
    }

    function endOnTarget(el, isError, options) {
        const st = getTargetState(el);
        st.pending = Math.max(0, st.pending - 1);
        if (isError) {
            st.errors++;
        }
        if (options && options.overlay) {
            st.overlayCount = Math.max(0, st.overlayCount - 1);
        }
        if (st.pending === 0) {
            clearTimeout(st.failsafe);
        }
        renderTarget(el);
    }

    // =========================================================================
    // Public API: window.ErmLoader
    // =========================================================================
    const ErmLoader = {
        ignoreUrls: defaultIgnoreUrls.slice(),

        /**
         * Anti-race token: panggil nextToken('soap') sebelum fetch pasien baru,
         * lalu cek isLatestToken('soap', token) di dalam callback .done().
         */
        nextToken: function (scopeKey) {
            const next = (tokenMap.get(scopeKey) || 0) + 1;
            tokenMap.set(scopeKey, next);
            return next;
        },

        isLatestToken: function (scopeKey, token) {
            return tokenMap.get(scopeKey) === token;
        },

        /**
         * Pantau 1 atau array jqXHR / Promise pada target modal/container tertentu.
         */
        watch: function (targetSelector, xhrOrList, options) {
            const opts = Object.assign({
                label: 'Memuat data...',
                overlay: false,
                lockButtons: null,
            }, options || {});

            const $target = $(targetSelector);
            const el = $target.length ? $target[0] : null;
            const list = (Array.isArray(xhrOrList) ? xhrOrList : [xhrOrList]).filter(function (item) {
                return item && typeof item.always === 'function';
            });

            if (!el || !list.length) {
                return $.Deferred().resolve().promise();
            }

            // Tandai agar auto-tracker global tidak menghitung ganda jika sudah dipantau manual
            list.forEach(function (xhr) {
                xhr._ermManualTracked = true;
            });

            startOnTarget(el, opts.label, opts);

            let failedCount = 0;
            let remaining = list.length;
            const dfd = $.Deferred();

            list.forEach(function (xhr) {
                xhr.fail(function () {
                    failedCount++;
                }).always(function () {
                    remaining--;
                    if (remaining === 0) {
                        endOnTarget(el, failedCount > 0, opts);
                        dfd.resolve({ failedCount: failedCount });
                    }
                });
            });

            return dfd.promise();
        },

        /**
         * Helper anti double-submit untuk tombol Simpan/Hapus di seluruh ERM.
         */
        button: function (btnSelector, jqXHR, loadingText) {
            const $btn = $(btnSelector);
            if (!$btn.length) return jqXHR;

            const originalHtml = $btn.data('ermOrigHtml') || $btn.html();
            $btn.data('ermOrigHtml', originalHtml);
            $btn.prop('disabled', true);
            $btn.html(
                `<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>${loadingText || 'Memproses...'}`
            );

            const restore = function () {
                $btn.html(originalHtml);
                $btn.prop('disabled', false);
            };

            if (jqXHR && typeof jqXHR.always === 'function') {
                jqXHR.always(restore);
            } else {
                setTimeout(restore, 600);
            }

            return jqXHR;
        },

        /**
         * Set status manual pada pill [data-erm-loader-status] di target tertentu.
         */
        setStatus: function (targetSelector, state, text) {
            const $target = $(targetSelector);
            if (!$target.length) return;
            renderTarget($target[0], state, text);
        },

        /**
         * Reset paksa loader jika diperlukan.
         */
        reset: function (targetSelector) {
            if (!targetSelector) {
                globalState.pending = 0;
                globalState.errors = 0;
                clearTimeout(globalState.failsafe);
                renderGlobal();
                return;
            }
            const $target = $(targetSelector);
            if (!$target.length) return;
            const el = $target[0];
            const st = getTargetState(el);
            st.pending = 0;
            st.overlayCount = 0;
            clearTimeout(st.failsafe);
            renderTarget(el, 'idle');
        },
    };

    // =========================================================================
    // Auto-Hook Global jQuery AJAX (Zero-Config untuk semua halaman & modal)
    // =========================================================================
    $(document).on('ajaxSend', function (event, jqXHR, settings) {
        if (!jqXHR || jqXHR._ermManualTracked || shouldIgnoreRequest(settings)) {
            return;
        }

        const topModal = getTopVisibleModal();
        if (topModal) {
            jqXHR._ermTargetModal = topModal;
            startOnTarget(topModal, $(topModal).attr('data-erm-loading-text') || 'Memuat data...');
        } else {
            jqXHR._ermTargetGlobal = true;
            globalState.pending++;
            clearTimeout(globalState.failsafe);
            globalState.failsafe = setTimeout(function () {
                ErmLoader.reset();
            }, FAILSAFE_MS);
            renderGlobal();
        }
    });

    $(document).on('ajaxComplete', function (event, jqXHR) {
        if (!jqXHR || jqXHR._ermManualTracked) {
            return;
        }

        const isError = jqXHR.status >= 400 || jqXHR.statusText === 'error' || jqXHR.statusText === 'timeout';

        if (jqXHR._ermTargetModal) {
            endOnTarget(jqXHR._ermTargetModal, isError);
            jqXHR._ermTargetModal = null;
        } else if (jqXHR._ermTargetGlobal) {
            globalState.pending = Math.max(0, globalState.pending - 1);
            if (globalState.pending === 0) {
                clearTimeout(globalState.failsafe);
            }
            renderGlobal();
            jqXHR._ermTargetGlobal = false;
        }
    });

    // Track modal yang sedang dalam transisi buka agar request pertama langsung menempel ke modal
    $(document).on('show.bs.modal', '.modal', function () {
        openingModal = this;
    });
    $(document).on('shown.bs.modal', '.modal', function () {
        if (openingModal === this) {
            openingModal = null;
        }
    });

    // Reset otomatis saat modal ditutup agar tidak menyisakan state lama
    $(document).on('hidden.bs.modal', '.modal', function () {
        if (openingModal === this) {
            openingModal = null;
        }
        ErmLoader.reset(this);
    });

    window.ErmLoader = ErmLoader;
})(window, window.jQuery);
