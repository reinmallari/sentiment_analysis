@extends ('layout/app')

@section ('style')
	<link rel="stylesheet" href="{{ URL::asset('assets/style/sentiment.css') }}">
@endsection

@section ('script')
	<script src="{{ URL::asset('assets/scripts/sidebar.js') }}" charset="utf-8"></script>
	<script src="{{ URL::asset('assets/scripts/script.js') }}" charset="utf-8"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
@endsection

@section ('content')
	@include ('partials/header')

  <div class="app-wrapper">
    <aside class="sidebar">
    	@include ('pages/sidebar')
    </aside>
	    <div class="main-content">
        <header class="header">
          	@include ('pages/navbar')
        </header>

        <section id="analyzer" class="content-section">
          	@include ('pages/sentiment_form')
        </section>

        <!-- List of Entered Text -->
				<section id="list" class="content-section" style="display: none;">
          <h2>List of All Entered Texts</h2>
					<table id="sentimentTable" class="display">
							<thead>
									<tr>
											<th>Sentiment Text</th>
											<th>Positive Count</th>
											<th>Negative Count</th>
											<th>Sentiment Result</th>
											<th>Sentiment Score</th>
									</tr>
							</thead>
							<tbody></tbody>
					</table>
        </section>
	    </div>
    </div>
@endsection
