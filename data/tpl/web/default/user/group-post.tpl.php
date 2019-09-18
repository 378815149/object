<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="new-keyword" id="js-user-group-post" ng-controller="UserGroupPost" ng-cloak>
	<ol class="breadcrumb we7-breadcrumb">
		<a href="<?php  echo url('user/group/display')?>"><i class="wi wi-back-circle"></i> </a>
		<li><a href="<?php  echo url('user/group/display')?>">用户组管理</a></li>
		<li>添加用户组</li>
	</ol>
	<form ng-submit="submit()" name="UserCreateForm" class="we7-form user-group-edit" ng-cloak>
		<div class="form-group">
			<label for="" class="control-label col-sm-2">用户权限组名</label>
			<div class="form-controls col-sm-8">
				<input type="text" name="name" class="form-control" ng-model="groupInfo.name">
			</div>
		</div>
		<div class="form-group">
			<label for="" class="control-label col-sm-2">创建账号个数</label>
			<div class="form-controls col-sm-8">
				<div class="we7-account-num-box">
					<div class="item" ng-repeat="(type, item) in we7TypeDefault" ng-if="type != 'welcome'">
						<div class="name"><i ng-class="item.icon"></i>{{item.name}}</div>
						<input type="text" name="{{'max' + type}}" required class="form-control" ng-model="groupInfo['max' + type]">
					</div>
				</div>
				<span class="help-block">创建账号个数，不能全部为0，至少要有一个</span>
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="control-label col-sm-2">有效期</label>
			<div class="form-controls col-sm-8">
				<div class="input-group">
					<input type="text" name="timelimit" class="form-control" ng-model="groupInfo.timelimit">
					<span class="input-group-addon font-default">天</span>
				</div>
			<span class="help-block">设置用户组的有效期限。0为不限制期限。到期后，该用户下的所有公众号只能使用 "基础服务"</span>
			</div>
		</div>
		
		<div class="form-group">
			<label for="" class="control-label col-sm-2">添加应用权限组</label>
			<div class="form-controls col-sm-8 user-create">
				<div class="we7-group-show " ng-repeat="(index, extend) in user_modules.groups" ng-if="extend.checked">
					<div class="name">
						{{extend.name}}
					</div>
					<div class="group-app-list">
						<div class="group-app-item" ng-repeat="module in extend.modules_all">
							<img src="{{module.logo}}" class="module-img" alt="">
							<div class="info">
								<div class="title text-over">
									{{module.title}}
								</div>
								<div class="type-list">
									<i ng-class="itme.icon" ng-repeat="itme in module.group_support | moduleInfo" ></i>
								</div>
							</div>
						</div>
						<div class="group-app-item" ng-repeat="module in extend.templates">
							<img src="{{module.logo}}" class="template-img" alt="">
							<div class="info">
								<div class="title">
									{{module.title}}
								</div>
								<div class="type-list">
									<i class="wi wi-template"></i>
								</div>
							</div>
						</div>
					</div>
					<a class="action"></a>
					<a href="" class="remove" ng-click="extend.checked = 0"><i class="wi wi-error"></i></a>
				</div>
				<we7-modal-app module-list="user_modules" multiple="true" on-confirm="loadChange()">
					<div class="add-new-block" >
						<i class="wi wi-plus"></i> 添加应用权限组
					</div>
				</we7-modal-app>
			</div>
		</div>
		<div class="col-sm-offset-2 clearfix">
			<input type="submit" name="submit" value="保存" class="btn btn-primary" ng-style="{'padding': '6px 50px'}" />
			<input type="hidden" name="token" value="<?php  echo $_W['token'];?>">
		</div>
	</form>
</div>
<script>
	angular.module('userGroup').value('config', {
		groupInfo: <?php echo !empty($group_info) ? json_encode($group_info) : 'null'?>,
		id : <?php echo !empty($_GPC['id']) ? $_GPC['id'] : 0?>,
		packages: <?php echo !empty($packages) ? json_encode($packages) : 'null'?>,
    	checkedGroup: <?php echo !empty($checked_groups) ? json_encode($checked_groups) : '[]'?>,
    	pagesize: <?php  echo $pagesize;?>,
		group_save_url : "<?php  echo url('user/group/save')?>",
	});
	angular.bootstrap($('#js-user-group-post'), ['userGroup']);
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>