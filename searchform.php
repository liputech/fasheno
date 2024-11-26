<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */
?>

<form role="search" method="get" class="fasheno-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-box">
		<input type="text" class="search-query form-control" placeholder="<?php esc_attr_e( 'Search here ...', 'fasheno' ) ?>" value="<?php echo get_search_query(); ?>" name="s">
		<button class="item-btn" type="submit">
			<span class="rt-icon-search"><svg xmlns="http://www.w3.org/2000/svg" width="22" height="23" viewBox="0 0 22 23"><path fill-rule="evenodd" clip-rule="evenodd" d="M6.06714 1.61988C7.23998 1.13407 8.49703 0.884033 9.7665 0.884033C11.036 0.884033 12.293 1.13407 13.4659 1.61988C14.6387 2.10569 15.7044 2.81775 16.602 3.7154C17.4997 4.61305 18.2117 5.67872 18.6975 6.85156C19.1833 8.02441 19.4334 9.28145 19.4334 10.5509C19.4334 11.8204 19.1833 13.0774 18.6975 14.2503C18.3398 15.114 17.8594 15.9195 17.2725 16.6427L21.3069 20.6771C21.6975 21.0677 21.6975 21.7008 21.3069 22.0914C20.9164 22.4819 20.2833 22.4819 19.8927 22.0914L15.8583 18.0569C14.1437 19.4485 11.9948 20.2178 9.7665 20.2178C7.20268 20.2178 4.74387 19.1993 2.93098 17.3864C1.11808 15.5736 0.0996094 13.1147 0.0996094 10.5509C0.0996094 7.9871 1.11808 5.52829 2.93098 3.7154C3.82863 2.81775 4.8943 2.10569 6.06714 1.61988ZM9.7665 2.88403C8.75967 2.88403 7.7627 3.08234 6.83251 3.46764C5.90232 3.85294 5.05713 4.41768 4.34519 5.12961C2.90737 6.56743 2.09961 8.51754 2.09961 10.5509C2.09961 12.5843 2.90737 14.5344 4.34519 15.9722C5.78301 17.4101 7.73311 18.2178 9.7665 18.2178C11.7999 18.2178 13.75 17.4101 15.1878 15.9722C15.8997 15.2603 16.4645 14.4151 16.8498 13.4849C17.2351 12.5547 17.4334 11.5578 17.4334 10.5509C17.4334 9.54409 17.2351 8.54712 16.8498 7.61693C16.4645 6.68674 15.8997 5.84155 15.1878 5.12961C14.4759 4.41768 13.6307 3.85294 12.7005 3.46764C11.7703 3.08234 10.7733 2.88403 9.7665 2.88403Z"></path></svg></span>
		</button>
	</div>
</form>
