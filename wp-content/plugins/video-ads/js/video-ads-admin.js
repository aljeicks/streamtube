var video_ads_type_obj 					= jQuery('#cactus_advs_type');
var video_ads_type 						= jQuery('#cactus_advs_type').val();
var file_advanced_upload 				= jQuery('.rwmb-file_advanced-wrapper');
var advs_video_url 						= jQuery('#advs_video_url').parents('.rwmb-field');
var advs_adsense_code 					= jQuery('#advs_adsense_code').parents('.rwmb-field');
var advs_url 							= jQuery('#advs_url').parents('.rwmb-field');
var advs_target 						= jQuery('#advs_target').parents('.rwmb-field');
var advs_position 						= jQuery('#advs_position').parents('.rwmb-field');

if(video_ads_type == 'image')
{
	file_advanced_upload.show();
	advs_url.show();
	advs_target.show();
	advs_position.show();
	advs_video_url.hide();
	advs_adsense_code.hide();
}
else if(video_ads_type == 'video')
{
	advs_video_url.show();
	advs_url.show();
	file_advanced_upload.hide();
	advs_target.hide();
	advs_position.hide();
	advs_adsense_code.hide();
}
else if(video_ads_type == 'html')
{
	advs_adsense_code.show();
	advs_position.show();
	advs_video_url.hide();
	advs_url.hide();
	file_advanced_upload.hide();
	advs_target.hide();
}
else
{
	advs_adsense_code.hide();
	advs_video_url.hide();
	advs_url.hide();
	file_advanced_upload.hide();
	advs_target.hide();
	advs_position.hide();
}

video_ads_type_obj.change(function(event) {
	if(jQuery(this).val() == 'image')
	{
		file_advanced_upload.show(200);
		advs_url.show(200);
		advs_target.show(200);
		advs_position.show(200);
		advs_video_url.hide(200);
		advs_adsense_code.hide(200);

	}
	else if(jQuery(this).val() == 'video')
	{
		advs_video_url.show(200);
		advs_url.show(200);
		file_advanced_upload.hide(200);
		advs_target.hide(200);
		advs_position.hide(200);
		advs_adsense_code.hide(200);
	}
	else if(jQuery(this).val() == 'html')
	{
		advs_adsense_code.show(200);
		advs_position.show(200);
		advs_video_url.hide(200);
		advs_url.hide(200);
		file_advanced_upload.hide(200);
		advs_target.hide(200);
	}
	else
	{
		advs_adsense_code.hide(200);
		advs_video_url.hide(200);
		advs_url.hide(200);
		file_advanced_upload.hide(200);
		advs_target.hide(200);
		advs_position.hide(200);
	}
});