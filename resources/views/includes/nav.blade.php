<div class="list-group">
  <a href="/myaccount" class="list-group-item">Edit Account</a>
  <a href="/account/changepassword" class="list-group-item">Change Password</a>
  <a href="/account/posts" class="list-group-item">Posts  <span class="badge">{{ \App\Http\Controllers\PostController::getCount() }}</span></a>
  <a href="account/transaction" class="list-group-item">Transactions</a>
 </div>
