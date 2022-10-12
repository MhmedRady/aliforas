@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<fieldset>
    <div class="form-card">

        <div class="row">
            <div class="col-7">
                <h3>Contact Information</h3>
                <p>This helps us always be able to reach you for any assistance you might need</p>
            </div>

        </div> <label class="fieldlabels">Name</label>
        <input type="text" name="name" value="" placeholder=""  />
        <label class="fieldlabels">Email</label>
        <input type="text" name="email" value=""   />

        <label class="fieldlabels">Contact Number</label>
        <input type="text" id="contact_number" name="contact_number" value="" placeholder="Contact Number" />

    </div>
    <input type="button" name="next" class="next action-button" value="save and continue" />
</fieldset>






