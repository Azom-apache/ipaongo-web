<form action="{{ route('dashboard.area.update',$area->id) }}" method="post">
      @csrf
      @method("PATCH")
      <div class="form-group">
         <label for="">Area</label>
         <input type="text" value="{{ $area->area }}" required="" name="area" class="form-control">
      </div>
      <div class="form-group">
         <label for="">District</label>
         <select name="district_id" required id="" class="form-control">
            <option value="" disabled="" selected=""> Select District </option>
            @foreach($districts as $district)
               <option @if($district->id == $area->district_id) selected @endif value="{{ $district->id }}">{{ $district->district_name }}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <button class="btn btn-success">
           Save
         </button>
      </div>
</form>