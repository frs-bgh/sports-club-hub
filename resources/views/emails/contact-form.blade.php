<h2>new contact message</h2>

<p><strong>name:</strong> {{ $msg->name }}</p>
<p><strong>email:</strong> {{ $msg->email }}</p>
<p><strong>subject:</strong> {{ $msg->subject }}</p>

<hr>

<p><strong>message:</strong></p>
<p>{!! nl2br(e($msg->message)) !!}</p>
