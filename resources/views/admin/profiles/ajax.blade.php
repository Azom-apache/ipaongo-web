@foreach($profiles as $profile)
     @php
       @$sl++; 
     @endphp
     <tr>
        <td style="width: 5%;">{{ $sl }}</td>
        <td>{{ $profile->name }}</td>
        <td>{{ $profile->username }}</td>
        <td>{{ $profile->mobile }}</td>
        <td>
           @if($profile->department)
              {{ $profile->department->department_name }}
           @endif
           @if($profile->district)
              - {{ $profile->district->district_name }}
           @endif
           @if($profile->area)
              - {{ $profile->area->area }}
           @endif
        </td>
        <td>
           
           <div class="btn-group">
              <a class="btn btn-warning" href="{{ route('dashboard.profiles.edit',$profile->id) }}">
                 <i class="fa fa-edit"></i>
              </a>
              <form action="{{ route('dashboard.profiles.destroy',$profile->id) }}" method="post">
                 @csrf
                 @method("DELETE")
                 <button class="btn btn-danger" onclick="return confirm('Are You Sure ?')">
                    <i class="fa fa-trash"></i>
                 </button>
              </form>
           </div>
        </td>
     </tr>
     @endforeach