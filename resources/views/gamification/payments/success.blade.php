<!-- DEPRECATED -->
<div class="container-fluid border-success text-center">
	<div class="card shadow-lg mt-4">
      <span class="badge bg-info w-50 mt-n2 mx-auto text-md text-center">Success</span>
      <div class="card-header text-center pt-4 pb-3 bg-transparent">
        <h3 class="font-weight-bold mt-2 text-white">£{{$trans->payment_amount}}</h3>
        <h5 class="text-muted">{{$trans->payment_note['metadata']['subject'] == 'coins' ? 'Coins' : 'Energy' }} {{ $trans->payment_note['metadata']['size'] }} | Boost</h5>
      </div>
      {{--
      <div class="card-body text-lg-start text-center pt-0">
        <div class="d-flex justify-content-lg-start justify-content-center p-2">
          <i class="material-icons my-auto text-white">done</i>
          <span class="ps-3 text-white">Transaction ID : {{ $trans->trans_code }}</span>
        </div>
        <div class="d-flex justify-content-lg-start justify-content-center p-2">
          <i class="material-icons my-auto text-white">done</i>
          <span class="ps-3 text-white">Payment Type : {{ ucfirst($trans->payment_type) }}</span>
        </div>
        <div class="d-flex justify-content-lg-start justify-content-center p-2">
          <i class="material-icons my-auto text-white">done</i>
          <span class="ps-3 text-white">Payment Date : {{ $trans->paid_at }}</span>
        </div>

        <div class="d-flex justify-content-lg-start justify-content-center p-2">
          <i class="material-icons my-auto text-white">done</i>
          <span class="ps-3 text-white">Tax Fee : £0.00 </span>
        </div>
        <div class="d-flex justify-content-lg-start justify-content-center p-2">
          <i class="material-icons my-auto text-white">done</i>
          <span class="ps-3 text-white">Transaction Fee : £0.00 </span>
        </div>
        <div onclick="javascript:window.close();" class="btn bg-gradient-medsnapp text-white font-weight-bold d-lg-block mt-3 mb-0">
          close window
        </div>
      </div>
      --}}
    </div>
</div>