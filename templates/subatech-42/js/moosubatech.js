
//------------------------------------------------------------------------------------
// TABS and ACCORDIONS
//------------------------------------------------------------------------------------

Element.implement({

	accordion : function() {
		
		var tabs = this;

		//set app mode
		document.body.addClass('featured-accordion');
		
		var tabsNav = tabs.getElement('#featured-links');

		// first move the links from a group up top
		// to just before each div
		tabsNav.getElements('a').each(function(a) {
			
			a.addClass("tabs");
			
			var divtabs = new Element('div.tabs');
			
			var link = document.getElement(a.get('href')); // target of link
			
			divtabs.adopt(a);
			
			divtabs.inject(link,'before');
			
			link.addClass('tabs-panel');
		});
		
		tabsNav.destroy();
		
		tabs.getElements('div.tabs > a').each(function(a) {
					
			a.addEvent('click',function(event) {
				toggleTab(a);
				a.focus();
				event.preventDefault();
			});
		});
		
		function toggleTab(tab) {
			if (tab.hasClass("tabs-selected")) {
				$$(tab.removeClass("tabs-selected").get('href')).removeClass('tabs-panel-selected');
			}
			else {
				$$(tab.addClass('tabs-selected').get('href')).addClass('tabs-panel-selected');
			}
		}
				
	},
	
	removeAccordion : function() {
	
		var tabs = this;

		document.getElement('body').removeClass('featured-accordion');
		
		var content = tabs.getElement('#featured-content');
		var links = new Element('ul#featured-links');
		
		links.inject(content,'before');

		content.getElements('a.tabs').each(function(item) {
			var p = item.getParent();
			item.removeClass('tabs');
			var listItem = new Element('li');
			listItem.adopt(item.clone());
			links.adopt(listItem);
			item.removeEvents();
			p.destroy();
		});
		
		content.getElements('div.tabs-panel').each(function(d) {
			d.removeClass('tabs-panel').set('style','');
			var p = d.getParent();
			d.inject(content);
			p.destroy();
		});
	},
	
	removeTabs : function() {
		
		var tabs = this;

		document.body.removeClass('featured-tabs');
				
		var links = tabs.getElement('#featured-links');
		var content = tabs.getElement('#featured-content');

		links.erase('role').removeClass('tabs-nav');
		links.getElements('li').each(function(item) {
			item.removeClass('tabs-selected').erase('role')
		.erase('id');
		});
		
		content.removeClass('tabs-body').getElements('div').each(function(item) {
			item.removeClass('tabs-panel').removeClass('tabs-panel-selected')
		.set('id',item.get('id').replace(/-enhanced$/,''));
		item.show();
		});
	},
	
	tabs: function() {
		
		//reference to tabs container
		var tabs = this;

		document.body.addClass('featured-tabs');

		var tabsNav = tabs.getElement('#featured-links');

		var tabsBody = tabs.getElement('#featured-content');

		var tabIDprefix = 'tab-';

		var tabIDsuffix = '-enhanced';

		tabsNav.addClass('tabs-nav').set('role', 'tablist');

		tabsBody.addClass('tabs-body');

		tabsBody.getElements('>div').each(function(item) {
			item.addClass('tabs-panel')
			.set('id', item.get('id') + tabIDsuffix);
		});

		//set role of each tab
		tabsNav.getElements('li').each(function(item) {
			item.set('id', tabIDprefix + item.getElement('a').get('href').split('#')[1]);
		});


		//generic select tab function
		function selectTab(tab) {
				//unselect tabs
				var selectedTab = tabsNav.getElement('li.tabs-selected');
				
				if ( selectedTab ) {
					selectedTab.removeClass('tabs-selected');
				}
				//set selected tab item
				tab.addClass('tabs-selected');
				//unselect  panels
				var selectedPanel = tabsBody.getElement('div.tabs-panel-selected');
				
				if ( selectedPanel ) {
					selectedPanel.set('aria-hidden', true).removeClass('tabs-panel-selected');
				}
				//select active panel
				document.getElement(tab.getElement('a').get('href') + tabIDsuffix).addClass('tabs-panel-selected');
		}

		tabsNav.getElements('li').each(function(item) {
			item.addEvent('click',function() {
			selectTab(item);
			item.focus();
			return false;
			});
		});

		selectTab(tabsNav.getFirst());
		
		return this;
	}
});

//------------------------------------------------------------------------------------
// TOP NAVIGATION
//------------------------------------------------------------------------------------

var subatech = {

	betternav2 : function(li) {
		// beautify "by hand" some main menus

		var div = new Element('div#visual-fat-menu');

		var header = new Element('div#menu-heading');

		var title = li.getElement('a').clone().set('id', 'menu-heading');

		header.adopt(title);

		var closeButtonSpan = new Element('span.btn_cancel',{ 'html' : '<button type="submit">X</button>' });

		header.adopt(closeButtonSpan);
		
		div.adopt(header);
		
		// start with the  uls with no separator
        var others = li.getChildren('ul > li > a');
        if ( others.length) {
            var othersDiv = new Element('div', { 'class': 'navgroup', 'html' : '<ul></ul>'});
            var ul = othersDiv.getElement('ul');
            others.each(function(o) {
                ul.adopt(o.getParent().clone());
            });
        
            div.adopt(othersDiv);
		}
		
		// make one div per ul, starting by the ones having a separator
		var a = li.getElements('span.separator');

		a.each(function(sep) {
			var d = new Element('div.navgroup');
			var title = new Element('h4',{ text: sep.get('text') });
			d.adopt(title);
			var sib = sep.getSiblings();
			sib.each(function(s) {
				d.adopt(s.clone());
			});
			div.adopt(d);
		});



		return div;
	},

	addExpandedNavigation : function() {

		// Add the expanded navigation div if it's not there
		// and attach the relevant event handler to the
		// primary links in order to show/hide it

		var navPrimaryFatMenu = document.id('nav-primary-fat-menu');
		
		if(navPrimaryFatMenu) {
			return false;
		}

		// create the expanded div
		navPrimaryFatMenu = new Element('div', { 'id' : "nav-primary-fat-menu" });
		
		navPrimaryFatMenu.inject(document.id('nav-primary'),'after');

		// create event handler so the click will show/hide the expanded nav
		var primaryLinks = document.id('nav-primary').getElements('ul:first-child > li > a');
		
		primaryLinks.each(function(elem) {

			var navPrimaryFatMenu = document.id('nav-primary-fat-menu');
			
			var slider = new Fx.Slide(navPrimaryFatMenu, {
				duration: 400,
				transition: Fx.Transitions.Quad.easeOut,
				resetHeight: true
			}).hide();
						
			elem.addEvent('click',function(event) {
				var li = elem.getParent();
				var ul = li.getElement('ul');

				if(!ul) {
					return;
				}

				event.preventDefault();

				var previous = li.getParent().getElement('li.open');
			
				if (previous) {
					previous.removeClass('open');
					if(previous.getElement('a').get('text')===this.get('text')) {
						slider.cancel();
						slider.slideOut();
						return;
					}
				}

				var animate = false;

				if(!navPrimaryFatMenu.hasChildNodes()) {
					animate = true;
				}

				navPrimaryFatMenu.empty();

				navPrimaryFatMenu.adopt(subatech.betternav2(li));

				navPrimaryFatMenu.getElement('button').addEvent('click',function() {
					slider.cancel();
					slider.slideOut();
					document.id('nav-primary').getElement('li[class~=open]').removeClass('open');
				});

				slider.cancel();
				slider.slideIn();
			
				li.addClass('open');

			});
		});
	},

	removeExpandedNavigation : function() {
		
		var fatMenu = document.id('nav-primary-fat-menu');
		
		if ( !fatMenu ) {
			return;
		}
		
		fatMenu.getParent().destroy();
				
		var links = document.id('nav-primary').getElements('ul:first-child > li');
		
		links.removeClass('open');
		links.getElements('a').each(function(a) {
			a.removeEvents();
		});
		
	},

	addCompactNavigation : function() {
		var nav = document.id('nav-primary'), e = nav.getElement('.btn-navbar');

		var body = document.id(document.body);
		if ( body.hasClass('compactnav') ) {
			return;
		}
		e = new Element('a', { 'class': "btn-navbar" });
		for(var i = 0; i < 3; ++i) {
			e.adopt(new Element('span', { 'class': "icon-bar" }));
			nav.adopt(e);
		}
		e.addEvent('click', function() {
			this.getParent().toggleClass('expanded');
		});

		document.body.addClass('compactnav').removeClass('regularnav');
	},

	removeCompactNavigation : function() {
	    var body = document.id(document.body);
		if ( body.hasClass('compactnav') ) {
			body.removeClass('compactnav').addClass('regularnav');
			body.getElement('#nav-primary').getElement('.btn-navbar').destroy();
		}
	},

	removeBannerImage : function() {
		var bannerimage = document.id('bannerimage');
		var img = bannerimage.get('img');
		if (img) {
			bannerimage.set('title', img.get('src')).empty().removeClass('expanded');
		}
	},

	addBannerImage : function() {
		
		var banner = document.id('bannerimage');
		var title = banner.get('title');
		if (title) {
			var link = new Element('img',{
				'src': title,
				'width': '100%'
			});
			banner.set('title','');
			banner.toggleClass('expanded');
			banner.adopt(link);
		}
	},

    checkTabs : function(ww) {
		/* ww is the browser's window width */
		
		var featured = document.id('featured');
		
		if (!featured)  {
			return;
		}

		var body = document.body;
			
		if ( ww > 9999999 ) {
			
			if (body.hasClass('featured-accordion')) {
				featured.removeAccordion();
			}
			if ( !body.hasClass('featured-tabs')) {
				featured.tabs();
			}
		}
		else {
			if (body.hasClass('featured-tabs')) {
				featured.removeTabs();
			}
			if ( !body.hasClass('featured-accordion')) {
				featured.accordion();
			}
		}
    },
    
	checkWidth : function() {

		var width = window.getCoordinates().width;
		if (width < 560) {
			this.removeBannerImage();
			this.removeExpandedNavigation();
			this.addCompactNavigation();
		} else {
			this.removeCompactNavigation();
			this.addExpandedNavigation();
			this.addBannerImage();
		}
		this.checkTabs(width);
	},
	
	sideShow : function() {
		// look for a category-list that is candidate
		// for a "side"show
		
		var div = document.getElement("div.category-list.sideshow");
		var sideShowDiv, sideShowDivSection;
		
		if (!div) {
   //			window.console.log('no sideshow to show');
			return;
		}
		
//		window.console.log('will show sideshow');
		
		var ul = div.getElement('ul');
		
		sideShowDiv = new Element('div.sideshow-content');
		
		sideShowDivSection = new Element('section');
		
		sideShowDiv.adopt(sideShowDivSection);
		
		sideShowDiv.inject(document.body,'bottom');
	
		sideShowDiv.hide();
					
		var bannerImage = document.id('bannerimage');
		
		var scrollHandler = function() {
			
			// if bannerimage is visible then we need to limit the top of the sideShowDiv
			
			if (!bannerImage) {
				return;
          }
          
           var y = bannerImage.getCoordinates().bottom - window.getScroll().y + 24;
           
           if ( y > 0 ) {
                sideShowDiv.set('styles', { 'top' : y });
            }
            else {
                sideShowDiv.set('styles', { 'top' : 0 });
			}
		};
		
//		sideShowDiv.set('styles',{ 'height' : '2000px' });
		
		ul.getChildren("li a").each(function(a) {
			
			var li = a.getParent();
			
			li.addClass("project");
						
			var projectTitle = new Element('div.project-title');
			
			var projectLink = new Element('div.project-link');
			
			var linkText = a.get("text").trim();

			var linkURL = a.get("href");
			
			var curl = linkURL + "?tmpl=component";
						
			projectLink.adopt(new Element('a',{ href: linkURL, text: '' }));
			
			var title = new Element('h2');
			
			title.adopt(new Element('a',{ href: linkURL, text: linkText }));
			
			projectTitle.adopt(title);

			li.adopt(projectTitle);
			li.adopt(projectLink);
			
			a.destroy();

			var spinner;
			
			var request = new Request.HTML({
				url : curl,
				method : 'get',
				link : 'cancel',
				async : false,
				onRequest : function() {
					spinner = new Spinner(sideShowDiv, {
						message : 'merci de patienter...'
					});
				},
				onComplete : function() {
					if (spinner) {
						spinner.destroy();
					}
				},
				onSuccess : function(responseTree, responseElements) {
					responseElements.each(function(e) {
						if ( e.hasClass('sideshow') ) {
							sideShowDivSection.set('html',e.get('html'));
						}
					});
				}
			});

			var newlink = projectLink.getElement('a');
			
			var hideLinkHandler = function(event) {
				event.preventDefault();
				sideShowDiv.hide();
				window.removeEvent('scroll',scrollHandler);
			};
					

			var showLinkHandler = function(event) {
				window.addEvent('scroll',scrollHandler);
				scrollHandler();
				sideShowDivSection.empty();
				sideShowDiv.show();
				request.send();
//				sideShowDivSection.set('html',newlink.get('href'));
				event.preventDefault();
			};

			newlink.addEvent('click',function(event) {
				event.preventDefault();
			});

			newlink.addEvent('mouseenter',showLinkHandler);

			newlink.addEvent('mouseleave',hideLinkHandler);

		});
	}
};

window.addEvent('domready',function() {
	subatech.checkWidth();
	subatech.sideShow();
});

if (!window.addEventListener) {
	window.attachEvent('onresize',function() {
		subatech.checkWidth();
	},false);
}
else {
	window.addEventListener('resize', function() {
		subatech.checkWidth();
	}, false);
}


