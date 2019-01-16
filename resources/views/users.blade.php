@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					User List to Approve
				</div>
				<div class="panel-body">
					@if ( session('message') )
						<div class="alert alert-success" role="alert">
							{{ session('message') }}
						</div>
					@endif

					<table class="table">
						<tr>
							<th>User name</th>
							<th>Email</th>
							<th>Registered at</th>
							<th>Updated at</th>
							<th></th>
						</tr>
						@forelse( $users as $user )
							<tr>
								<td>{{ $user->name }} 
									@if( $user->admin )
										<span class="label label-success">Admin</span>
									@endif
									@if( $user->approved_at == null )
										<span class="label label-warning">Pending approve</span>
									@endif
								</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->created_at }}</td>
								<td>{{ $user->updated_at }}</td>
								<td>
									<a href="{{ route('admin.users.show_edit', $user->id) }}" class="btn btn-success btn-sm">Edit</a>
									@if( $user->approved_at == null )
										<a href="{{ route('admin.users.approve', $user->id) }}" class="btn btn-primary btn-sm">Approve</a>
									@endif
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="4">No user found.</td>
							</tr>
						@endforelse
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection