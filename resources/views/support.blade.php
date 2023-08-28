@extends('layouts.app')

@section('title-page')Droniverse | Тех.поддержка@endsection

@section('content')
<div style="width: 100vw; display: flex; justify-content: center">
    <!-- minified snippet to load TalkJS without delaying your page -->
    <script>
        (function(t,a,l,k,j,s){
            s=a.createElement('script');s.async=1;s.src="https://cdn.talkjs.com/talk.js";a.head.appendChild(s)
            ;k=t.Promise;t.Talk={v:3,ready:{then:function(f){if(k)return new k(function(r,e){l.push([f,r,e])});l
                        .push([f])},catch:function(){return k&&new k()},c:l}};})(window,document,[]);
    </script>

    <!-- container element in which TalkJS will display a chat UI -->
    <div id="talkjs-container" style="width: 90%; margin: 30px; height: 500px">
        <i>Загрузка чата...</i>
    </div>
    <script>
        Talk.ready.then(function () {
            @if($role == 2){
                var me = new Talk.User({
                    id: '9328290',
                    name: 'Droniverse Team',
                    email: 'droniverse@example.com',
                    photoUrl: '{{ asset('images/messengerAvatar.png') }}',
                    welcomeMessage: 'Приветствуем! Что у вас случилось?'
                });
                var other = new Talk.User({
                    id: '111',
                    name: 'Чат технической поддержки',
                    email: '{{$user->email}}',
                    photoUrl: '{{ asset('images/messengerAvatar.png') }}',
                    welcomeMessage: 'Выберите пользователя слева и ответьте на его сообщение.',
                });
            }
            @elseif($role == 0){
                var me = new Talk.User({
                    id: '{{$user->id}}',
                    name: '{{$user->login}}',
                    email: '{{$user->email}}',
                    photoUrl: '{{asset('images/personMessenger.png')}}',
                    welcomeMessage: 'Здравствуйте.',
                });
                var other = new Talk.User({
                    id: '9328290',
                    name: 'Droniverse Team',
                    email: 'droniverse@example.com',
                    photoUrl: '{{ asset('images/messengerAvatar.png') }}',
                    welcomeMessage: 'Приветствуем! Что у вас случилось?'
                });
            }
            @endif
            window.talkSession = new Talk.Session({
                appId: 'tHxhIJVV',
                me: me,
            });


            var conversation = talkSession.getOrCreateConversation(
                Talk.oneOnOneId(me, other)
            );
            conversation.setParticipant(me);
            conversation.setParticipant(other);

            var inbox = talkSession.createInbox({ selected: conversation });
            inbox.mount(document.getElementById('talkjs-container'));
        });
    </script>
</div>
@endsection
