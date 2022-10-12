<div id="personal-info-modern" class="content ml-0" role="tabpanel" aria-labelledby="personal-info-modern-trigger">
    <div class="content-header">
        <h5 class="mb-0">{{__('auth.PERSONAL DETAIL')}}</h5>
        <small>{{__('seller.setPInfo')}}</small>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label req class="form-label" for="first_name">{{__('auth.fName')}}</label>
                <input type="text" id="document_first_name" class="form-control" name="first_name" value="{{old('first_name')??$user->first_name}}"/>
                @error('first_name')
                    <div id="validationDocument_first_name" class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label req class="form-label" for="last_name">{{__('auth.lName')}}</label>
                <input type="text" id="document_last_name" class="form-control" name="last_name" value="{{old('last_name')??$user->last_name}}"/>
                @error('last_name')
                    <div id="validationDocument_last_name" class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label class="form-label" for="document_id">{{__('auth.NID')}}</label>
                <input type="text" id="document_id" class="form-control" name="document_id" value="{{old('document_id')??($user->seller->document_id??0)}}"/>
                @error('document_id')
                    <div id="validationDocument_id" class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label class="form-label" for="dob">{{__('auth.birthDate')}}</label>
                <input type="date" id="dob" class="form-control" name="dob" value="{{old('dob')??$user->dob}}"/>
                @error('dob')
                    <div id="validationDocument_first_name" class="invalid-feedback d-block">
                        {{$message}}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <div class="form-group">
                <label id="gender" class="form-label" for="dob">{{__('auth.gender')}}</label>
                <select id="gender" class="form-control" name="gender">
                    <option value="1" {{old('gender')??$user->gender=='Male'?'selected':''}}>
                        {{__('auth.male')}}
                    </option>
                    <option value="2" {{old('gender')??$user->gender=='Female'?'selected':''}}>
                        {{__('auth.female')}}
                    </option>
                </select>
                @error('gender')
                <div id="validationDocument_first_name" class="invalid-feedback d-block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <button class="btn btn-primary btn-prev" type="button">
            <i data-feather="arrow-left" class="align-middle me-sm-25 me-0"></i>
            <span class="align-middle d-sm-inline-block d-none">{{__('layouts.prev')}}</span>
        </button>
        <button class="btn btn-primary btn-next" type="button" type="button">
            <span class="align-middle d-sm-inline-block d-none">{{__('layouts.next')}}</span>
            <i data-feather="arrow-right" class="align-middle ms-sm-25 ms-0"></i>
        </button>
    </div>
</div>
