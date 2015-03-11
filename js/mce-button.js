(function() {
	tinymce.PluginManager.add('we_paypal_mce_button', function( editor, url ) {
		editor.addButton( 'we_paypal_mce_button', {
			text: 'Paypal Button',
			icon: 'paypal-we-icon',
            onclick: function() {
                
                editor.windowManager.open( {
                    title: 'Configure your paypal button',
                    body: [
                        {
                            type: 'textbox',
                            name: 'webPaypalId',
                            label: 'Button ID',
                            value: '01'
                        },
                        {
                            type: 'textbox',
                            name: 'webPaypalText',
                            label: 'Button Text',
                            value: 'Buy Now'
                        },
                        {
                            type: 'textbox',
                            name: 'webPaypalName',
                            label: 'Product Name',
                        },
                        {
                            type: 'textbox',
                            name: 'webPaypalPrice',
                            label: 'Product Price',
                            value: '10'
                        },
                        {
                            type: 'textbox',
                            name: 'webPaypalEmail',
                            label: 'Paypal Email',
                            value: ''
                        },
                        {
                            type: 'textbox',
                            name: 'webPaypalQuantity',
                            label: 'Quantity',
                            value: '1'
                        }, 
                        {
                            type: 'textbox',
                            name: 'webPaypalCurrency',
                            label: 'Currenct Code',
                            value: 'USD'
                        },    
                        {
                            type: 'listbox',
                            name: 'webPaypalType',
                            label: 'Button Type',
                            'values': [
                                {text: 'Buy Now', value: 'buynow'},
                                {text: 'Subscribe', value: 'subscribe'},
                                {text: 'Donate', value: 'donate'}
                            ]
                        },    
   
                        {
                            type: 'listbox',
                            name: 'webPaypalStyle',
                            label: 'Button Style',
                            'values': [
                                {text: 'Default Style', value: 'default'},
                                {text: 'Style Two', value: 'one'},
                                {text: 'Style Three', value: 'two'},
                                {text: 'Style Four', value: 'three'}
                            ]
                        },
                        {
                            type: 'listbox',
                            name: 'webPaypalTarget',
                            label: 'Button Target',
                            'values': [
                                {text: 'Same Window', value: '_self'},
                                {text: 'New Window', value: '_blank'}
                            ]
                        },                         
                        {
                            type: 'textbox',
                            name: 'webPaypalColor',
                            label: 'Color',
                            value: '#009CDE'
                        }, 
                    ],
                        
                        
                    onsubmit: function( e ) {
                        editor.insertContent( '[paypal id="' + e.data.webPaypalId + '" text="' + e.data.webPaypalText + '" product="' + e.data.webPaypalName + '" email="' + e.data.webPaypalEmail + '" price="' + e.data.webPaypalPrice + '" currency="' + e.data.webPaypalCurrency + '" quantity="' + e.data.webPaypalQuantity + '" type="' + e.data.webPaypalType + '" style="' + e.data.webPaypalStyle + '" target="' + e.data.webPaypalTarget + '" color="' + e.data.webPaypalColor + '"]');
                    }
                });
            }
		});
	});
})();