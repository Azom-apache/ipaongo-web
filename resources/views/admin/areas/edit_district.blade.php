<form action="{{ route('dashboard.area.district.update',$district->id) }}" method="post">
  @csrf
  @method("PATCH")

  <div class="form-group">
     <label for="">District Name</label>
     <input type="text"  value="{{ $district->district_name }}" required="" name="district_name" class="form-control">
  </div>
  <div class="form-group">
     <button class="btn btn-success">Save</button>
  </div>
</form>