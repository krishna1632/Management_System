<nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">

            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Dashboard
            </a>
            <div class="sb-sidenav-menu-heading"> Study Mast</div>
            <a class="nav-link" href="{{ url('#') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Upload PYQ
            </a>
            <a class="nav-link" href="{{ url('#') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                Study Materials
            </a>
            <a class="nav-link" href="{{ url('#') }}">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                RoadMaps
            </a>



            <div class="sb-sidenav-menu-heading">More Actions</div>
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSocieties"
                aria-expanded="false" aria-controls="collapseSocieties">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Quiz Mast
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseSocieties" aria-labelledby="headingOne"
                data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ url('admin/societies') }}">Create Quiz</a>
                    <a class="nav-link" href="{{ url('admin/societies') }}">Create Quiz Repoarts</a>
                </nav>
            </div>

            {{-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseQuiz"
                aria-expanded="false" aria-controls="collapseQuiz">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Societies/Event
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a> --}}
            {{-- <div class="collapse" id="collapseQuiz" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="#"> Events/Announcement </a>
                                    <a class="nav-link" href="{{ url('admin/quiz') }}">Issue Certificate</a>

                                    <a class="nav-link" href="{{ url('admin/quiz') }}">Atendence Participates</a>
                                </nav>
                            </div> --}}



        </div>
    </div>

</nav>
