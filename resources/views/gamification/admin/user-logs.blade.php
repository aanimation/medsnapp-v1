<div class="">
	<div class="container-fluid py-4">
		<div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-2 pt-4 pb-0">
                        <div class="d-flex">
                            <div class="w-70">
                                <h6 class="text-white text-capitalize ps-3">User Logs - <span>{{ $model->last_name }}</span></h6>
                            </div>
                            <div class="w-30 text-end">
                                <ul class="nav nav-pills bg-dark text-end" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button wire:click.prevent="changeTab('question')" class="nav-link {{ $tab == 'question' ? 'active' : '' }} shadow-none text-white text-sm p-3 py-1" id="question-tab" data-bs-toggle="tab" data-bs-target="#question" type="button" role="tab" aria-controls="question" aria-selected="true">Question</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button wire:click.prevent="changeTab('patient')" class="nav-link {{ $tab == 'patient' ? 'active' : '' }} shadow-none text-white text-sm p-3 py-1" id="patient-tab" data-bs-toggle="tab" data-bs-target="#patient" type="button" role="tab" aria-controls="patient" aria-selected="false">Patient</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button wire:click.prevent="changeTab('currency')" class="nav-link {{ $tab == 'currency' ? 'active' : '' }} shadow-none text-white text-sm p-3 py-1" id="currency-tab" data-bs-toggle="tab" data-bs-target="#currency" type="button" role="tab" aria-controls="currency" aria-selected="false">Currency</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button wire:click.prevent="changeTab('invite')" class="nav-link {{ $tab == 'invite' ? 'active' : '' }} shadow-none text-white text-sm p-3 py-1" id="invite-tab" data-bs-toggle="tab" data-bs-target="#invite" type="button" role="tab" aria-controls="invite" aria-selected="false">Invite</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-4">
                        <div class="tab-content mb-3">
                            <div class="tab-pane fade {{ $tab == 'question' ? 'show active' : '' }}" id="question" role="tabpanel" aria-labelledby="question-tab">
                                @include('gamification.admin.logs.question')
                            </div>
                            <div class="tab-pane fade {{ $tab == 'patient' ? 'show active' : '' }}" id="patient" role="tabpanel" aria-labelledby="patient-tab">
                                @include('gamification.admin.logs.patient')
                            </div>
                            <div class="tab-pane fade {{ $tab == 'currency' ? 'show active' : '' }}" id="currency" role="tabpanel" aria-labelledby="currency-tab">
                                Currency
                            </div>
                            <div class="tab-pane fade {{ $tab == 'invite' ? 'show active' : '' }}" id="invite" role="tabpanel" aria-labelledby="invite-tab">
                                Invite
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>