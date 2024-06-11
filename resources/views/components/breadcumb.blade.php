 <div class="page-header d-print-none my-2">
     <div class="container-fluid">
         <div class="row align-items-center">
             <div class="col">
                 <h6 class="page-title" style="font-size:0.9rem">
                     @if (count(Request::segments()))
                         @for ($i = 1; $i <= count(Request::segments()); $i++)
                             {{ ucfirst(Request::segment($i + 1)) }}
                             @if (($i < count(Request::segments())) & ($i >= 1))
                                 >
                             @endif
                         @endfor
                     @else
                         Beranda
                     @endif
                 </h6>
             </div>
         </div>
     </div>
 </div>
