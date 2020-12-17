<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) {
    redirect_to("./login/");
}
?>
<?php include_layout_template('admin_header.php'); ?>


<div class="row dashboard">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
              <!-- /.row -->
              <div class="row">
                <?php if ($session->has_permission('EventView')) { ?>
                <div class="col-lg-3 col-md-6 dashboard-float">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-th fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo Event::count_all("WHERE site_id=".$session->site_id)?></div>
                                    <div><?php echo read_xmls('/site/event/titles/main') ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                <a href="<?php echo menu::admin_link('EventView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
              <?php }?>
              <?php if ($session->has_permission('GalleryView')) { ?>
                  <div class="col-lg-3 col-md-6 dashboard-float">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-play-circle-o fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge"><?php echo Media::count_by_sql_stat("select a.* from medias a where exists (select 1 from galleries b where a.gallery_id=b.id and b.site_id={$session->site_id})")?></div>
                                      <div><?php echo read_xmls('/site/media/titles/main') ?></div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">

                                  <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                  <a href="<?php echo menu::admin_link('GalleryView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                  <?php }?>
                  <?php if ($session->has_permission('MainCategoryView')) { ?>
                  <div class="col-lg-3 col-md-6 dashboard-float">
                      <div class="panel panel-green">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-list-alt fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge"><?php echo Subject::count_by_sql_stat("select a.* from subjects a where exists (select 1 from mains b where a.main_id=b.id and b.site_id={$session->site_id})")?></div>
                                      <div><?php echo read_xmls('/site/subject/titles/main') ?></div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">

                                  <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                  <a href="<?php echo menu::admin_link('MainCategoryView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                <?php }?>
                  <?php if ($session->has_permission('PageView')) { ?>
                  <div class="col-lg-3 col-md-6 dashboard-float">
                      <div class="panel panel-yellow">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-desktop fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                      <div class="huge"><?php echo Page::count_all("WHERE site_id=".$session->site_id)?></div>
                                      <div><?php echo read_xmls('/site/page/titles/main') ?></div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">

                                  <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                  <a href="<?php echo menu::admin_link('PageView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                  <?php }?>

          
              <?php if ($session->has_permission('MailGroupView')) { ?>
              <div class="col-lg-3 col-md-6 dashboard-float">
                  <div class="panel panel-red">
                      <div class="panel-heading">
                          <div class="row">
                              <div class="col-xs-3">
                                  <i class="fa fa-group fa-5x"></i>
                              </div>
                              <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo Mail::count_all("WHERE mail_groups_id=(select id from mail_groups where newsletter=1)")?></div>
                                <div><?php echo read_xmls('/site/mailgroup/titles/newsletter') ?></div>
                              </div>
                          </div>
                      </div>
                      <a href="#">
                          <div class="panel-footer">

                              <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                              <a href="<?php echo menu::admin_link('MailGroupView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                              <div class="clearfix"></div>
                          </div>
                      </a>
                  </div>
              </div>
            <?php }?>
          <?php if ($session->has_permission('AdSectionView')) { ?>
                <div class="col-lg-3 col-md-6 dashboard-float">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-pagelines fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <div class="huge"><?php echo Ad::count_by_sql_stat("select a.* from ads a where exists (select 1 from ads_sections b where a.adsec_id=b.id and b.site_id={$session->site_id})")?></div>
                                  <div><?php echo read_xmls('/site/ad/titles/main') ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">

                                <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                <a href="<?php echo menu::admin_link('AdSectionView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
              <?php }?>
              <?php if ($session->has_permission('ContactsView')) { ?>
                <div class="col-lg-3 col-md-6 dashboard-float">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-phone fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <div class="huge"><?php echo Contacts::count_all("WHERE site_id=".$session->site_id)?></div>
                                  <div><?php echo read_xmls('contact_us') ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">

                                <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                <a href="<?php echo menu::admin_link('ContactsView  ')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php }?>
                <?php if ($session->has_permission('LogFileView')) { ?>
                  <div class="col-lg-3 col-md-6 dashboard-float">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              <div class="row">
                                  <div class="col-xs-3">
                                      <i class="fa fa-user-secret  fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo ActivityLog::count_all("WHERE site_id=".$session->site_id)?></div>
                                    <div><?php echo read_xmls('activity_logs') ?></div>
                                  </div>
                              </div>
                          </div>
                          <a href="#">
                              <div class="panel-footer">

                                  <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                  <a href="<?php echo menu::admin_link('LogFileView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                  <div class="clearfix"></div>
                              </div>
                          </a>
                      </div>
                  </div>
                  <?php }?>
              <?php if ($session->has_permission('JoinRequestView')) { ?>
                <div class="col-lg-3 col-md-6 dashboard-float">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <div class="huge"><?php echo JoinRequest::count_all()?></div>
                                  <div><?php echo read_xmls('/site/join_requests/titles/main') ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">

                                <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                <a href="<?php echo menu::admin_link('JoinRequestView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <?php }?>
                <?php if ($session->has_permission('JobRequestView')) { ?>
                <div class="col-lg-3 col-md-6 dashboard-float">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo JobRequest::count_all()?></div>
                                    <div><?php echo read_xmls('/site/jobrequest/titles/main') ?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">

                                <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?>"><i class="fa fa-arrow-circle-<?php echo read_xmls('/site/config/otheralign') ?>"></i></span>
                                <a href="<?php echo menu::admin_link('JobRequestView')?>"><span class="pull-<?php echo read_xmls('/site/config/align') ?>"> &nbsp;<?php echo read_xmls('/site/frontend/news/labels/more') ?>&nbsp;</span></a>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
              <?php }?>
            </div>
            <!-- /.row -->
            <div class="row">
                <!-- /.col-lg-8 -->
                <div class="col-lg-12 visit-stats">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-stats"></i> <?php echo read_xmls('/site/siteconfigs/titles/sitecounter') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-male fa-fw"></i> <?php echo read_xmls('/site/siteconfigs/lables/counter') ?>
                                    <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?> text-muted small"><em><?php echo @SiteConfig::site_config('counter'); ?></em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-male fa-fw"></i> <?php echo read_xmls('/site/page/lables/stats') ?>
                                    <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?> text-muted small"><em><?php echo Page::all_visits("WHERE site_id=".$session->site_id)?></em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-male fa-fw"></i> <?php echo read_xmls('/site/gallery/lables/stats') ?>
                                    <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?> text-muted small"><em><?php echo Gallery::all_visits("WHERE site_id=".$session->site_id)?></em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-male fa-fw"></i> <?php echo read_xmls('/site/subject/lables/stats') ?>
                                    <span class="pull-<?php echo read_xmls('/site/config/otheralign') ?> text-muted small"><em><?php echo Subject::all_visits("a where exists (select 1 from mains b where a.main_id=b.id and b.site_id={$session->site_id})")?></em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <!-- <a href="#" class="btn btn-default btn-block">View All Alerts</a> -->
                        </div>
                        <!-- /.panel-body -->
                    </div>

                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
            </div>
            </div>
        </div>
    </div>
</div>


<?php include_layout_template('admin_footer.php'); ?>
