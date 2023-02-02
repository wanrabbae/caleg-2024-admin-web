@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.youtube.com/embed/96bxFhd1-tQ" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen="" class="col-md-12" height="355" frameborder="0"></iframe>
            </div>
            <div class="col-md-6">
                {{-- <embed src="http://caleg.jagat.store/assets/info/Profil.pdf" quality="high" name="fb" allowscriptaccess="always" allowfullscreen="true" pluginpage="http://www.adobe.com/go/getreader"
                    type="application/pdf" width="100%" height="1100"> --}}
                <embed src="https://www.jagatgenius.com/assets/images/Profil.pdf" type="application/pdf" quality="high" name="100%" class="col-md-12" height="355" allowscriptaccess="always" allowfullscreen="true" pluginpage="http://www.adobe.com/go/getreader">
            </div>
        </div>
    </div>
@endsection
