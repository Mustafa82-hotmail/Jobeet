<?php use_stylesheet('jobs.css') ?>
 
<div id="jobs">
  <?php foreach ($categories as $category): ?>
    <div class="category_<?php echo Jobeet::slugify($category->getName()) ?>">
      <div class="category">
        <div class="feed">
          <a href="">Feed</a>
        </div>
          <h1><?php echo link_to($category->getSlug(),  url_for('category',$category) )?></h1>
      </div>
      <?php include_partial('job/list',array('jobs' => $category->getActiveJobs()))?>
      <?php if((($count=$category->countActiveJobs()- sfConfig::get('max_jobs', 10))>0)):?>
      
        <?php echo link_to($count,'category',$category)?>
      <?php endif;?>
    </div>
  <?php endforeach; ?>
</div>