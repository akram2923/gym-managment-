<?php

include "sidebar.php";
include "header.php";

?>

<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Blank Page</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Empty card</h5>
								</div>
								<div class="card-body">
                                <form>
										<div class="form-group">
											<label class="form-label">Email address</label>
											<input type="email" class="form-control" placeholder="Email">
										</div>
										<div class="form-group">
											<label class="form-label">Password</label>
											<input type="password" class="form-control" placeholder="Password">
										</div>
										<div class="form-group">
											<label class="form-label">Textarea</label>
											<textarea class="form-control" placeholder="Textarea" rows="1"></textarea>
										</div>
										<div class="form-group">
											<label class="form-label w-100">File input</label>
											<input type="file">
											<small class="form-text text-muted">Example block-level help text here.</small>
										</div>
										<div class="form-group">
											<label class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input">
              <span class="custom-control-label">Check me out</span>
            </label>
										</div>
										<button type="submit" class="btn btn-primary">Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
            </main>
            
<?php

include "footer.php";

?>