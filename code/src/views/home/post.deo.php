<div class="row d-flex align-items-center justify-content-center">
    <div class="col-md-6">
    <?php
        if (isset($message)) {
            echo '<div class="alert alert-info">' . $message . '</div>';
        }
        if (isset($error)) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
    ?>
        <form method="POST" action="/home/create/" enctype="multipart/form-data">
            <div class="card--black px-5 py-5">
                <span class="circle"></span>
                <h5 class="mt-3">Post a image</h5> 
                <small class="mt-2 text-muted">
                    Write description for image:
                </small>
                <br />
                <textarea name="description" class="form-control" style="resize: none; height: 100px;"></textarea>
                <div class="form-input my-4">
                    <label for="image" class="mb-2">Choose image</label>
                    <br />
                    <input type="file" name="image" class="form-control-file" id="image" accept="image/*" required>
                </div>
                <label for="level" class="mb-2">Share level</label>
                <select class="form-select" name="level" id="level" aria-label="">
                    <option value="public" selected>Public</option>
                    <option value="logged">Logged-in users</option>
                    <option value="private">Private</option>
                </select>
                <div class="d-grid gap-2">
                    <input type="submit" id="submit" class="btn btn-primary mt-4 signup" value="Upload" />
                </div>
            </div>
        </form>
    </div>
</div>