//Onebip select switcher by ChoMPi

function onebipSwitch(obj)
{
	$this = $(obj);
	
	var item_code = $this.find(':selected').val();
	var price = $this.find(':selected').attr('price');
	var descr = $this.find(':selected').attr('descr');
	
	$('#onebip-input-item').val(item_code);
	$('#onebip-input-price').val(price);
	$('#onebip-input-descr').val(descr);
}