<!DOCTYPE html>
<html lang="<?php echo $tm->getCurrentLocaleIdentifier(); ?>" xmlns="http://www.w3.org/1999/xhtml">
<head> 
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<base href="<?php echo $ro->getBaseHref(); ?>" />
	<title>Static files Master template example</title>
	
	<?php echo $slots['static_files']; ?>
	
</head>
<body>
</body>
</html>