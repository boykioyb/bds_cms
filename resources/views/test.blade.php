<!DOCTYPE html>
<!--
Copyright (c) 2007-2018, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or https://ckeditor.com/sales/license/ckfinder
-->
<html>
<head>
    <meta charset="utf-8">
    <title>CKFinder 3 Samples</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]>
    <![endif]-->
</head>
<body>
<div id="ckfinder-widget"></div>

<script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
<script>
    CKFinder.widget( 'ckfinder-widget', {
        width: '100%',
        height: 700,
        skin: 'moono'
    } );
</script>
{{--<script src="//cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js" type="text/javascript"></script>--}}

</body>
</html>
