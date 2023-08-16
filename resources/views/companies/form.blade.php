 @include('shared.errors')
 <div class="mb-3 mt-4">
     <label class="form-label">Name</label>
     <span class="error">*</span>
     <input class="form-control" value="{{ old('company_name', $company ? $company->company_name : '') }}" type="text"
         name="company_name" placeholder="Company name" />
 </div>
 <div class="mb-3 mt-4">
     <label class="form-label">Address</label>
     <span class="error">*</span>
     <input class="form-control" value="{{ old('company_address', $company ? $company->company_address : '') }}"
         type="text" name="company_address" placeholder="Company Adress" />
 </div>
 <div class="mb-3 mt-4">
     <label class="form-label">Logo</label>
     <input class="form-control" value="{{ old('company_image', $company ? $company->company_image : '') }}"
         type="file" name="company_logo" placeholder="Company name" />
 </div>
