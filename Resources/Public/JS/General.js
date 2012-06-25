Ext.onReady(function(){

	/**
	 * Expand a contact list item
	 */
	Ext.select('.exp-coll').on('click', function(e,t){
		info = Ext.get(t).up('td').next().child('.more-data');
		if(info.isVisible()) {
			Ext.get(this).removeClass('expanded');
			info.removeClass('active')
			info.slideOut('t', {
				useDisplay: true,
				duration: .2
			});
		} else {
			Ext.get(this).addClass('expanded');
			info.addClass('active')
			info.slideIn('t', {
				useDisplay: true,
				duration: .2
			});
		}
	});
});