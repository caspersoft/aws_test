<div class="card">
    <div class="card-body">
        <form method=POST action="/upload" class="form-inline" enctype="multipart/form-data">
            <div class="row">
                <div class="input-group">
                    <input type="text" name="name" placeholder="Task Name" class="form-control" required>

                    <input type="file" name="file" class="form-control" required>

                    <div class="input-group-append">
                        <button class="btn btn-primary my-2 my-sm-0 col" type="submit">Create Task</button>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</div>