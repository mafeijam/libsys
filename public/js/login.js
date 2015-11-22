$('#username, #password').focus(function(){
	$(this).siblings('.label').animate({bottom:'50px', fontSize:'14px'}, 300).css('color', '#222')
	$(this).css('border-bottom', '1px solid #222')
	$('.label').removeClass('error')
	$('.error-box').fadeOut(300)
})

$('#username, #password').blur(function(){
	if ($(this).val() == '') {
		$(this).siblings('.label').animate({bottom:'10px',fontSize:'20px'}, 300).css('color', '#828282')
		$(this).css('border-bottom', '1px solid #828282')
	}
})

$('#username, #password').click(function(){
	$(this).select()
})

if ($('#username').val() !== '') {
	$('#username').siblings('.label').animate({bottom:'50px', fontSize:'14px'}, 0)
}

if ($('#password').val() !== '') {
	$('#password').siblings('.label').animate({bottom:'50px', fontSize:'14px'}, 0)
}

$(window).resize(function(){
	if ($(window).height() < 520) {
		$('.login').css('transform', 'translate(-50%, 0%)').css('top', '100px')
	} else {
		$('.login').css('transform', 'translate(-50%, -50%)').css('top', '50%')
	}
})