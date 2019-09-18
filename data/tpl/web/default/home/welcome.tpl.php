<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="welcome-container"  id="js-home-welcome" ng-controller="WelcomeCtrl" ng-cloak>
    <?php  if(permission_check_account_user('statistics_fans', false)) { ?>
    <div class="panel we7-panel account-stat">
        <div class="panel-heading">
            <h4>今日/昨日</h4>
        </div>
        <div class="panel-body we7-padding-vertical">
            <div class="col-sm-3 text-center">
                <div class="title">新关注</div>
                <div>
                    <span class="today" ng-init="0" ng-bind="fans_kpi.today.new"></span>
                    <span class="pipe">/</span>
                    <span class="yesterday" ng-init="0" ng-bind="fans_kpi.yesterday.new"></span>
                </div>
            </div>
            <div class="col-sm-3 text-center">
                <div class="title">取消关注</div>
                <div>
                    <span class="today" ng-init="0" ng-bind="fans_kpi.today.cancel"></span>
                    <span class="pipe">/</span>
                    <span class="yesterday" ng-init="0" ng-bind="fans_kpi.yesterday.cancel"></span>
                </div>
            </div>
            <div class="col-sm-3 text-center">
                <div class="title">净增关注</div>
                <div>
                    <span class="today" ng-init="0" ng-bind="fans_kpi.today.jing_num"></span>
                    <span class="pipe">/</span>
                    <span class="yesterday" ng-init="0" ng-bind="fans_kpi.yesterday.jing_num"></span>
                </div>
            </div>
            <div class="col-sm-3 text-center">
                <div class="title">累计关注</div>
                <div>
                    <span class="today" ng-init="0" ng-bind="fans_kpi.all"></span>
                </div>
            </div>
        </div>
    </div>
    <?php  } ?>

    <!-- 公告 start -->
    <div class="panel we7-panel">
        <div class="panel-heading">
            <h4>公告</h4>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#notice" aria-controls="notice" role="tab" data-toggle="tab" >系统公告</a>
                </li>
                
                <li role="presentation" >
                    <a href="#we7notice" aria-controls="we7notice" role="tab" data-toggle="tab" >微擎公告</a>
                </li>
                
            </ul>
            <a href="./index.php?c=article&a=notice-show" class="color-default more">更多</a>
            <?php  if(permission_check_account_user('see_notice_post')) { ?><a href="./index.php?c=article&a=notice&do=post" class="color-default more">+新建</a><?php  } ?>
        </div>
        <div class="panel-body">
            <div class="tab-content" >
                <div class="tab-pane active" id="notice">
                    <ul class="list-group notice-statistics" >
                        <li class="list-group-item" ng-repeat="notice in notices" ng-if="notices && notices.length">
                            <a ng-href="{{notice.url}}" class="text-over" target="_blank" ng-style="{'color': notice.style.color, 'font-weight': notice.style.bold ? 'bold' : 'normal'}" ng-bind="notice.title"></a>
                            <span class="pull-right color-gray" ng-bind="notice.createtime"></span>
                        </li>
                        <div class="we7-empty-block" ng-if="!notices.length"> 
                            暂无公告
                        </div>
                    </ul>
                </div>
                
                <div class="tab-pane" id="we7notice" >
                    <ul class="list-group notice-statistics">
                        <script type="text/javascript" src="//bbs.w7.cc/api.php?mod=js&bid=20"></script>
                    </ul>
                </div>
                
            </div>
        </div>
    </div>
    <!-- 公告 end -->
    
    <div class="panel we7-panel">
        <div class="panel-heading">
            <h4>推荐应用</h4>
            <ul class="nav nav-tabs" role="tablist">
				<li role="presentation" :ng-class="{active: key == 'recommend'}" ng-click="changeTab(key)" ng-repeat="(key, item) in recommend"><a href="{{'#' + key}}" role="tab" aria-controls="{{key}}" data-type="{{key}}" data-toggle="tab" >{{item.name}}</a></li>
			</ul>
            <a href="http://s.w7.cc/" target="_blank" class="more">去市场</a>
        </div>
        <div class="panel-body">
			<div class="tab-content">
				<div class="tab-pane " :ng-class="{active: key == 'recommend'}"  id="{{key}}" ng-repeat="(key, item) in recommend">
					<div class="app-statistics">
						<div class="left-box">
							<div id="{{key + '-app-carousel'}}" class="carousel slide recommend-app-carousel" data-ride="carousel">
								<ol class="carousel-indicators">
									<li data-target="{{'#' + key + '-app-carousel'}}" data-slide-to="{{index}}"  ng-class="{active: index == 0}" ng-repeat="(index, ad) in item.ads"></li>
								</ol>
								<div class="carousel-inner" role="listbox">
									<div class="item advertising-box" ng-class="{active: index == 0}" ng-repeat="(index, ad) in item.ads">
										<a ng-href="{{ad.url}}" target="_blank">
											<img ng-src="{{ad.cdn_logo}}" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="go-store" ng-if="key != 'recommend' && item.ads.length == 0">
								<div class="icon">
									<img ng-src="{{'resource/images/welcome/' + item.icon + '-icon.png'}}" alt="">
								</div>
								<div class="name">
									{{item.name}}
								</div>
								<div class="title">
									网罗市场最新应用，更快了解最新应用
								</div>
								<a href="//s.w7.cc" class="btn btn-primary">去应用市场</a>
							</div>
						</div>
						<div class="right-box">
							<a ng-href="{{'//s.w7.cc/module-'+app.aid+'.html'}}" target="_blank" class="app-item" ng-repeat="app in item.list">
								<div class="app-item-box">
									<div class="info">
										<div class="logo">
											<img ng-src="{{app.cdn_logo}}" alt="">
										</div>
										<div class=" text-over">
											<div class="name text-over" ng-bind="app.title"></div>
											<div class="time" ng-bind="'下载次数' + app.down_count"></div>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    
</div>
<script>
	angular.module('homeApp').value('config', {
        family: "<?php  echo IMS_FAMILY?>",
		notices: <?php echo !empty($notices) ? json_encode($notices) : 'null'?>,
        'apiLink': '//api.w7.cc',
	});
	angular.bootstrap($('#js-home-welcome'), ['homeApp']);
	$(function(){
		$('[data-toggle="tooltip"]').tooltip();
		var $topic = $('.welcome-container .notice .menu .topic');
		var $ul = $('.welcome-container .notice ul');

		$topic.mouseover(function(){
			var $this = $(this);
			var $index = $this.index();
			if ($this.is('.we7notice')) {
				$this.parent().prev().hide();
			} else {
				$this.parent().prev().show();
			}
			$topic.removeClass('active');
			$this.addClass('active');
			$ul.removeClass('active');
			$ul.eq($index).addClass('active');
		})
	})
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>