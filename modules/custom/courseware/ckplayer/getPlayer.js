var video = jQuery('video.edui-upload-video');
var src = video.attr('src');
jQuery(video).parent().attr('id', 'targetVideo');
//video.attr('id', 'targetVideo');
var type = video.attr('type');
var width = video.attr('width');
var height = video.attr('height');
var flashvars={
    f: src,
    c:0
};
var video=[src + '->' + type];
CKobject.embed('/modules/custom/courseware/ckplayer/ckplayer.swf','targetVideo','ckplayer_a1',width,height,false,flashvars,video);
