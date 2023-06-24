<style media="print">body,html{font-family:Arial,Helvetica,sans-serif}img{width:100px;margin:40px auto 30px;display:block!important}.list-group-flush{border-radius:0}.list-group{display:flex;flex-direction:column;padding-left:0;border-radius:.25rem;margin:40px auto 0;width:70%}.list-group-flush>.list-group-item{border-width:0 0 1px}.list-group-item:first-child{border-top-left-radius:inherit;border-top-right-radius:inherit}.list-group-item{position:relative;display:block;padding:.5rem 1rem;color:#212529;text-decoration:none;background-color:#fff;border:1px solid rgba(0,0,0,.125)}</style>
<img src="{{ asset('/images/logo.png') }}" alt="{!! settings()->get("page_logo_alt") !!}" style="display: none">
<ul class="list-group list-group-flush">
    <li class="list-group-item">Kurs: <b>{{ $questionnaire->exam->name }}</b></li>
    <li class="list-group-item">Data kursu: <b>{{ $questionnaire->examDate->start }}</b></li>
    <li class="list-group-item">Jak ocenia Pani/Pan organizację kursu w trybie e-learningu: <b>{{ $questionnaire->organisation }}</b></li>
    <li class="list-group-item">Jak ocenia Pani/Pan jasność i zrozumiałość komunikatów: <b>{{ $questionnaire->intelligibility }}</b></li>
    <li class="list-group-item">Jak ocenia Pani/Pan łatwość zarejestrowania się na kurs (w serwisie): <b>{{ $questionnaire->registration }}</b></li>
    <li class="list-group-item">Jak ocenia Pani/Pan jakość materiałów dydaktycznych (pisanych): <b>{{ $questionnaire->tmaterials }}</b></li>
    <li class="list-group-item">Jak ocenia Pani/Pan jakość materiałów dydaktycznych video: <b>{{ $questionnaire->vmaterials }}</b></li>
    <li class="list-group-item">Jak ocenia Pani/Pan trudność testu zaliczeniowego: <b>{{ $questionnaire->difficulty }}</b></li>
    <li class="list-group-item">Czy czas trwania kursu jest odpowiedni: <b>{{ $questionnaire->time }}</b></li>
</ul>
@if($questionnaire->dodatkowe)
    <hr>
    <p>{{ $questionnaire->dodatkowe }}</p>
@endif