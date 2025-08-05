<div wire:ignore class="modal fade" id="modal-greeting" tabindex="-1" aria-labelledby="greetingModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content" style="background: rgba(0,0,0,0.0)!important">
      <div class="modal-body">
        <img src="/assets/img/greetings/victory-patient.png" width="100%" height="auto" class="img-responsive"/>

        <div class="text-center">
          {{--
          <button wire:click.prevent="redirectFinish({{$userQuest->id}})" type="button" class="btn btn-md text-white font-weight-bolder bg-gradient-medsnapp">Continue</button>
          --}}
          <button wire:click.prevent="redirectFinish({{$userQuest->id}})" type="button" class='glowing-btn'><span class='glowing-txt'>Continue</span></button>
        </div>
      </div>
    </div>
  </div>
</div>