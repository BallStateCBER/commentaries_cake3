<p>
	<?= $user['name']; ?>,
</p>

<p>
	You have been subscribed to the newsmedia alert service for Mike Hicks's Weekly Commentaries.
	Every Wednesday at approximately 2:00pm EST, we will send you an email alert containing a link to the next commentary due to be published.
	Also, you can visit <a href="<?= $newsmediaIndexUrl; ?>"><?= $newsmediaIndexUrl; ?></a>
	at any time to view the next commentary to publish, if it's available.
</p>

<p>
	You can now log in to the Weekly Commentary website at
	<a href="<?= $loginUrl; ?>"><?= $loginUrl; ?></a>
	using the following information.
</p>
<ul>
	<li>
		Email: <?= $user['email']; ?>
	</li>
	<li>
		Password: <?= $user['password']; ?>
	</li>
</ul>

<p>
	Once logged in, you can
</p>
<ul>
	<li>
		Change your email address
	</li>
	<li>
		Change your password
	</li>
	<li>
		Unsubscribe from email alerts
	</li>
	<li>
		Subscribe other members of the newsmedia to email alerts
	</li>
</ul>

<p>
	If you have any questions, please email
	<a href="mailto:cber@bsu.edu">cber@bsu.edu</a>.
</p>

<p>
	<br />
	Ball State Center for Business and Economic Research
	<br />
	<a href="mailto:cber@bsu.edu">
		cber@bsu.edu
	</a>
	<br />
	<a href="http://www.bsu.edu/cber">
		www.bsu.edu/cber
	</a>
	<br />
	765-285-5926
</p>
