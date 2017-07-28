<?= $email; ?>,

Someone (presumably you) just requested that your password for <a href="https://commentaries.cberdata.org">CBERData's Weekly Commentary</a> be reset
so you can log in again. We would just TELL you what your password is, but since
it's stored in a one-way encrypted format, we actually have no way to figure out what it is.

Anyway, just click on this link and you'll be prompted to enter in a new password to overwrite
your old one.

<?= $resetUrl; ?>


NOTE: That link will only work for the rest of <?= date('F Y'); ?>.
If you need to reset your password in <?= date('F', strtotime('+1 month')); ?>, you'll need
to request another password reset link. That's so if you forget to delete this email and some creep
finds it later, they won't be able to use it to get into your account. Still, it would be a good
idea to delete this email as soon as you've reset your password.

Ball State Center for Business and Economic Research
https://www.bsu.edu/cber
