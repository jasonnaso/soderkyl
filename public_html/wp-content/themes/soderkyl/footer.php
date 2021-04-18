<?php

	$footer_address				= get_field('footer_address', 'option');
	$footer_scroll_top_icon		= get_field('footer_scroll_top_icon', 'option');
	$footer_open_times			= get_field('footer_open_times', 'option');

?>
		<footer class="section-padding">
			<div class="container">
				<div class="row">
					<?php if ($footer_scroll_top_icon) :?>
						<div class="col-sm-4 footer-scroll d-sm-none" id="footer-chevron-scroll-mobile">
							<?= $footer_scroll_top_icon; ?>
						</div>
					<?php endif; ?>
				</div>
				<div class="row">
					<?php if ($footer_address) :?>
						<div class="col-sm-4 footer-address">
							<?= $footer_address; ?>
						</div>
					<?php endif; ?>
					<?php if ($footer_scroll_top_icon) :?>
						<div class="col-sm-4 footer-scroll d-none d-sm-block" id="footer-chevron-scroll">
							<?= $footer_scroll_top_icon; ?>
						</div>
					<?php endif; ?>
					<?php if ($footer_open_times) :?>
						<div class="col-sm-4 footer-open-times">
							<?= $footer_open_times; ?>
						</div>
					<?php endif; ?>
				</div>

			</div>
			<?php wp_footer(); ?>
		</footer>
	</body>
</html>