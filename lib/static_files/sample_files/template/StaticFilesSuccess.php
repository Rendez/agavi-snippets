<?php foreach($t['sf:style'] as $name => $file): ?>
	<link rel="stylesheet" href="<?php echo sprintf('%s%s', $file, '?ts='.$t['ts']); ?>" type="text/css" media="screen, projection" />
<?php endforeach; ?>

<link rel="stylesheet" href="<?php echo AgaviConfig::get('com.project.stylesheet'); ?>extras/print.css?ts=<?php echo $t['ts']; ?>" type="text/css" media="print" />

<!--[if gte IE 7]><link rel="stylesheet" href="<?php echo AgaviConfig::get('com.project.stylesheet'); ?>extras/ie.css?ts=<?php echo $t['ts']; ?>" type="text/css" media="screen, projection" /><![endif]-->

<?php foreach($t['sf:script'] as $name => $file): ?>
	<script type="text/javascript" charset="utf-8" src="<?php echo sprintf('%s%s', $file,(strpos($file,'?')?htmlentities('&'):'?').'ts='.$t['ts']); ?>"></script>
<?php endforeach; ?>