<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Rails, Spring, Blazor, Django, Flask & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->
@include('component.head')
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<!--begin::Theme mode setup on page load-->
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-theme-mode");
			} else {
				if (localStorage.getItem("data-theme") !== null) {
					themeMode = localStorage.getItem("data-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-theme", themeMode);
		}
	</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::App-->
	<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
		<!--begin::Page-->
		<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
			<!--begin::Header-->
			<div id="kt_app_header" class="app-header">
				<!--begin::Header container-->
				<div class="app-container container-fluid d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
					<!--begin::sidebar mobile toggle-->
					<div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
						<div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
							<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
							<span class="svg-icon svg-icon-1">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
									<path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
								</svg>
							</span>
							<!--end::Svg Icon-->
						</div>
					</div>
					<!--end::sidebar mobile toggle-->
					<!--begin::Mobile logo-->
					<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
						<a href="../../demo1/dist/index.html" class="d-lg-none">
							<img alt="Logo" src="assets/media/logos/default-small.svg" class="h-30px" />
						</a>
					</div>
					<!--end::Mobile logo-->
					<!--begin::Header wrapper-->
					@include('component.navbar')
					<!--end::Header wrapper-->
				</div>
				<!--end::Header container-->
			</div>
			<!--end::Header-->
			<!--begin::Wrapper-->
			<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
				<!--begin::Sidebar-->
				@include('component.sidebar')
				<!--end::Sidebar-->
				<!--begin::Main-->
				<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
					<!--begin::Content wrapper-->
					<div class="d-flex flex-column flex-column-fluid">
						<!--begin::Toolbar-->
						<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
							<!--begin::Toolbar container-->
							<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
								<!--begin::Page title-->
								<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
									<!--begin::Title-->
									<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
										<?php 
										if (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'admin-dashboard'){
											echo('Dashboard');
										} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'buku'){
											echo('Data Buku');
										} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'createPeminjaman'){
											echo('Peminjaman Buku');
										} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'pengembalian'){
											echo('Pengembalian Buku');
										} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'perpanjangan'){
											echo('Perpanjangan Buku');
										} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'peminjaman'){
											echo('Data Peminjaman');
										} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'dataAnggota'){
											echo('Data Anggota');
										} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'pengunjung'){
											echo('Data Kunjungan');
										} else {
											echo(str_replace('/','',$_SERVER["REQUEST_URI"]));
										}
										?>
									</h1>
									<!--end::Title-->
									<!--begin::Breadcrumb-->
									<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item">
											<span class="bullet bg-gray-400 w-5px h-2px"></span>
										</li>
										<!--end::Item-->
										<!--begin::Item-->
										<li class="breadcrumb-item text-muted">
											<?php 
											if (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'admin-dashboard'){
												echo('Dashboard');
											} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'buku'){
												echo('Data Buku');
											} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'createPeminjaman'){
												echo('Peminjaman Buku');
											} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'pengembalian'){
												echo('Pengembalian Buku');
											} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'perpanjangan'){
												echo('Perpanjangan Buku');
											} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'peminjaman'){
												echo('Data Peminjaman');
											} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'dataAnggota'){
												echo('Data Anggota');
											} elseif (str_replace('/','',$_SERVER["REQUEST_URI"]) == 'pengunjung'){
												echo('Data Kunjungan');
											} else {
												echo(str_replace('/','',$_SERVER["REQUEST_URI"]));
											}
											?>
										</li>
										<!--end::Item-->
									</ul>
									<!--end::Breadcrumb-->
								</div>
								<!--end::Page title-->
								<!--begin::Actions-->
								
								<!--end::Actions-->
							</div>
							<!--end::Toolbar container-->
						</div>
						<!--end::Toolbar-->
						<!--begin::Content-->
						<div id="kt_app_content" class="app-content flex-column-fluid">
							<!--begin::Content container-->
							<div id="kt_app_content_container" class="app-container container-fluid">
								@yield('content')
							</div>
							<!--end::Content container-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Content wrapper-->
					<!--begin::Footer-->
					@include('component.footer')
					<!--end::Footer-->
				</div>
				<!--end:::Main-->
			</div>
			<!--end::Wrapper-->
		</div>
		<!--end::Page-->
	</div>
	<!--end::App-->
	<!--begin::Drawers-->
	<!--begin::Activities drawer-->

	<!--end::Activities drawer-->
	<!--begin::Chat drawer-->

	<!--end::Chat drawer-->
	<!--end::Drawers-->
	<!--begin::Engage drawers-->
	<!--begin::Demos drawer-->

	<!--end::Demos drawer-->
	<!--begin::Help drawer-->

	<!--end::Help drawer-->
	<!--end::Engage drawers-->
	<!--begin::Engage toolbar-->

	<!--end::Engage toolbar-->
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
				<path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->
	<!--begin::Modals-->
	<!--begin::Modal - Upgrade plan-->

	<!--end::Modal - Upgrade plan-->
	<!--begin::Modal - Create App-->

	<!--end::Modal - Create App-->
	<!--begin::Modal - New Target-->

	<!--end::Modal - New Target-->
	<!--begin::Modal - View Users-->

	<!--end::Modal - View Users-->
	<!--begin::Modal - Users Search-->

	<!--end::Modal - Users Search-->
	<!--begin::Modal - Invite Friends-->

	<!--end::Modal - Invite Friend-->
	<!--end::Modals-->
	<!--begin::Javascript-->
	@include('component.js')
	<!--end::Javascript-->
</body>
<!--end::Body-->

</html>