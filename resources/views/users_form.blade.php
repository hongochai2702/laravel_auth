@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Edit account</div>
					<div class="panel-body">
						@if ( session('message') )
							<div class="alert alert-success" role="alert">
								{{ session('message') }}
							</div>
						@endif
						@if ($errors->any())
						    <div class="alert alert-danger">
						        <ul>
						            @foreach ($errors->all() as $error)
						                <li>{{ $error }}</li>
						            @endforeach
						        </ul>
						    </div>
						@endif
						<form class="" action="{{ route('admin.users.post_edit', $user->id) }}" id="account_form" method="POST">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="user_fullname">Name</label>
								<input type="text" name="name" class="form-control" id="user_fullname" value="{{ $user->name }}" placeholder="Enter the full name." required/>
							</div>
							<div class="form-group">
								<label for="user_email">Email</label>
								<input type="email" name="email" class="form-control" id="user_email" value="{{ $user->email }}" placeholder="Enter the email." required/>
							</div>
							<div class="form-group">
								<div class="checkbox">
									<label><input type="checkbox" name="is_admin" value="yes" {{ $user->admin != 0 ? 'checked' : '' }} /> Is Admin</label>
								</div>
							</div>
							<div class="form-group">
								<div class="checkbox">
									<label><input type="checkbox" name="approve_status" value="yes" {{ $user->approved_at != null ? 'checked' : '' }} /> Approve user</label>
								</div>
							</div>
							<div class="form-group">
								<button class="btn btn-primary" type="submit" name="submit_form">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection