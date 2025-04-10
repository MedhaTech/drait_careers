<!-- Career Openings Section -->
<section class="career-current-opening">
    <div class="container">
        <a href="<?= base_url(''); ?>" class="btn btn-apply mb-3">← Back to Posts</a>
        <div class="row">
            <article class="card p-4">
                <h2 class=""><?= $post->title; ?></h2>
                <p class="text-muted">
                    <small>
                        Posted by <strong>Admin</strong> on <?= date('F j, Y', strtotime($post->updated_on)); ?>
                    </small>
                </p>
                <hr>
                <div class="blog-content">
                    <!-- Job Description -->
                    <p><?= $post->description; ?></p>

                    <!-- Departments -->
                    <h5>Departments</h5>
                    <p><?= $this->admin_model->getdeptpost($post->departments); ?></p>

                    <!-- Apply Button -->
                    <div class="mt-4">
                        <a href="<?= base_url('recruitment'); ?>" class="btn btn-apply">
                            Apply Now
                        </a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
