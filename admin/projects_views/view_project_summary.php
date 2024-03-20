<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `project_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
function duration($dur = 0){
    $hours = floor($dur / (60 * 60));
    $min = floor($dur / (60)) - ($hours*60);
    $dur = sprintf("%'.02d",$hours).":".sprintf("%'.02d",$min);
    return $dur;
}
?>
<div class="content py-4">
    <div class="card card-outline card-navy shadow rounded-0">
        <div class="card-header">
            <h5 class="card-title">Project Details</h5>
            <div class="card-tools">
                <?php if(isset($status) && $status == 1): ?>
                <button class="btn btn-sm btn-default bg-gradient-navy btn-flat" id="close_project">Close Project</button>
                <?php endif; ?>
                <?php if(isset($status) && $status != 2): ?>
                <button class="btn btn-sm btn-primary btn-flat" id="edit_project"><i class="fa fa-edit"></i> Edit Details</button>
                <button class="btn btn-sm btn-danger btn-flat" id="delete_project"><i class="fa fa-trash"></i> Delete Details</button>
                <?php endif; ?>
                <a href="./?page=projects" class="btn btn-default border btn-sm btn-flat"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Project</label>
                            <div class="pl-4"><?= isset($project_title) ? $project_title : 'N/A' ?></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label text-muted">Status</label>
                            <div class="pl-4">
                                <?php 
                                    switch ($status){
                                        case 0:
                                            echo '<span class="rounded-pill badge badge-success bg-gradient-teal px-3">New</span>';
                                            break;
                                        case 1:
                                            echo '<span class="rounded-pill badge badge-primary bg-gradient-primary px-3">In-Progress</span>';
                                            break;
                                        case 2:
                                            echo '<span class="rounded-pill badge badge-dark bg-gradient-dark px-3 text-light">Closed</span>';
                                            break;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label class="control-label text-muted">Description</label>
                        <div>
                            <?= html_entity_decode($description) ?>
                        </div>
                    </div>
                </div>
                <div class="clear-fix my-3"></div>
                <!-- <h3 class="border-bottom"><b>Reports</b></h3>
                <table class="table table-bordered table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="10%">
                        <col width="20%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr class="bg-gradient-primary text-light">
                            <th class="text-center">#</th>
                            <th class="text-center">Date Created</th>
                            <th class="text-center">Employee</th>
                            <th class="text-center">Work Type</th>
                            <th class="text-center">Duration (HH:mm)</th>
                            <th class="text-center">Report</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $i = 1;
                            $qry = $conn->query("SELECT r.*, w.name as work_type, e.code as ecode, CONCAT(e.firstname,' ',e.middlename,' ', e.lastname) as fullname FROM `report_list` r inner join `work_type_list` w on r.work_type_id = w.id inner join employee_list e on r.employee_id = e.id where r.project_id = '{$id}' order by unix_timestamp(r.date_created) desc ");
                            while($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="px-2 py-1 text-center"><?= $i++; ?></td>
                                <td class="px-2 py-1"><?= date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                <td class="px-2 py-1"><?= $row['fullname'] ?></td>
                                <td class="px-2 py-1"><?= $row['work_type'] ?></td>
                                <td class="px-2 py-1 text-right"><?= duration($row['duration']) ?></td>
                                <td class="px-2 py-1"><p class="m-0 truncate-1"><?= strip_tags(html_entity_decode($row['description'])) ?></p></td>
                                <td class="px-2 py-1 text-center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                            </table>
 -->


    <div>
        
    </div>

    <div>
        
        <div class="bd-example bd-example-flex " style="border: .5px solid black;">
            <div class="d-flex flex-wrap">
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">OVERVIEW</a></div>
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">DOCUMENT</a></div>
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">FINANCE</a></div>
                <div class="p-2"><a class="nav-link fontSizeInNav" href="#">TASKS/MILSTONES</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">PROJECT SUMMERY</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">LOGFRAME</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">PARTICIPANTS</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">AGREEMENTS</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">MEMEBERS</a></div>
                <div class="p-2"> <a class="nav-link fontSizeInNav" href="#">PROJECT CHANGES</a></div>
            </div>
        </div>

        <div>

            <div>
                <!-- <div class="row flex-wrap" style="list-style: none;">
                    <li class="" style="width: fit-content;">Project narrative</li>
                    <li class="" style="width: fit-content;">Project information for marketing & communication</li>
                </div> -->
                <!-- <div>

                    <button class="mt-3" type="button" style="border: .5px solid black; border-radius: 5px;">Edit
                        project narrative</button>

                </div> -->
            </div>
            <div class="" id="mainDiv">


                <div class="mt-2">
                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Short project description</label>
   
                    <li class="firstList">
                            </li>
                        <li>
                            <p> The project targets 8.000 households in 07 villages councils of tehsil Besham and
                                Chakisar of
                                district Shangla and 8 villages councils of tehsil Pattan district Kohistan Lower,
                                through
                                activities including agriculture support, nutrition awareness and income generating
                                activities</p>
                        </li>
                    </ul>
                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Framework conditions</label>
                        <li class="firstList"></li>
                        <li>
                            <p>The National Nutrition Survey 2018 for Pakistan reports that 37% of the country's
                                population
                                is food insecure, half of whom are severely food insecure. 40.2% of children under 5 are
                                too
                                short for their age (43.5% in rural areas), 17.7% are emaciated (have too little weight
                                relative to their height), 28.9% are underweight and 9.5% are overweight. 51.5% of
                                Pakistani
                                children suffer from vitamin A deficiency, 12.1% of them severely. Similarly, half of
                                the
                                female population (15-49 years) is underweight; 42% are anaemic & over a quarter (i.e.
                                27%)
                                of them are vitamin A deficient. The drinking water of 56.5% of the country's population
                                is
                                contaminated with E coli, while 36% drink water contaminated with E coli. Although 93%
                                of
                                the population has access to improved water sources, almost no one treats the water
                                before
                                use. 84% of the population has access to sanitation, however, 60% of the population does
                                not
                                safely dispose of children's stool. Only 5.1% of the population in KP province has
                                social
                                security. Food security statistics in KP province are almost the same as at the national
                                level.

                                Shangla district is in Malakand division, while Kohistan is in Hazara division, both in
                                the
                                northwestern province of Khyber Pakhtunkhwa (KP) in Pakistan. Both are neighbouring
                                districts, mountainous, arid & with high poverty prevalence. Both districts are rated
                                "medium to high" in terms of recurrent food insecurity and disaster risk, and "lowest"
                                on
                                the human development index compared to other districts in the province and country.
                                This
                                region is vulnerable to complex emergencies and multiple hazards due to high disaster
                                risk
                                from floods, earthquakes and glacial lake outburst floods (GLOFs).

                                The COVID-19 pandemic that started in Pakistan in March 2020, with the restrictions on
                                mobility imposed between May and August, and thus restrictions on income and
                                procurement,
                                are worsening the food situation of the population, and administrative and official
                                processes are slowed down.</p>
                        </li>
                    </ul>
                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Problem statement</label>

                        <!-- <li class="firstList">Problem statement </li> -->
                        <li>
                            <p><strong>Poverty:</strong> 73.6% of the population in Shangla and 89.4% in Kohistan are
                                considered
                                multidimensionally poor. In the ranking of "poorest districts", Kohistan ranks 2nd
                                poorest in the country & 1st poorest in Khyber Pakhtunkhwa province, while Shangla ranks
                                2nd poorest in the same Khyber Pakhtunkhwa province (KP). 57% of households in Shangla
                                and 84% in Kohistan are among the poorest in the "wealth index quintile"</p>
                            <p><strong>Food security</strong> Both districts are classified as "very vulnerable to food
                                insecurity". Only 6.6% of children (under 2 years,) in Shangla and 4% in Kohistan
                                achieve minimum dietary diversity with 4 out of 7 recommended food groups consumed per
                                day, while only 4.4% of children (U2) in Shangla and 2% in Kohistan enjoy a minimally
                                acceptable diet in terms of nutrient supply and frequency of meals. 100% of the
                                population in Shangla and Kohistan live in rural areas, where over 80% of the population
                                have access to land, which, however, has limited cultivability due to the mountainous
                                terrain. In both districts, over 65% of households keep livestock</p>
                            <p><strong>Nutrition:</strong> Of the children under 5 years of age, 78.7% in Shangla and
                                59.4% in Kohistan are moderately and severely growth retarded (too small for their age).
                                51% of children in Shangla & 44.4% in Kohistan are moderately to severely underweight
                                and about 8% & 17% in Shangla & Kohistan are too light for their size (emaciated). More
                                than 53% of children in the province suffer from anaemia. In KP province, the prevalence
                                of underweight children (U5) is 23.1%. Emaciation, i.e. too light for their height, is
                                15% (which is alarming, but still lower than the national rate), 40% of children are too
                                small for their age (stunting)</p>
                            <p><strong>Women's health:</strong> About 50% of girls in both districts give birth to
                                children aged 15-19 years due to traditions and socio-religioushidden hunger".</p>
                            <p><strong>WASH:</strong> Around 85% of respondents in Shangla and as low as 66% of
                                respondents in Kohistan reported having access to what they perceived to be safe water
                                sources.

                            </p>
                        </li>
                    </ul>
                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Risk assessment</label>

                        <li class="firstList"> </li>
                        <li>
                        <li class="">The following risks have been identified with the degree and level of
                            severity. Mitigation measures have been peroposed and responsibilities assigned for
                            mitigation measure.

                        </li>
                        <li>
                            <ul class="listStyteDot">
                                <li>Late Partnership Agreements - MOU (LASOONA, NIDA and WHH) with Economic Affairs
                                    Division (EAD) and Ministry of Interiot (MOI) and project-specific No-objection
                                    Certificate (NOC) from the Provincial Planning and Development Department.</li>
                                <li>Cultural constraints on women's participation and their negative impact on women's
                                    role in the family create mistrust between family members</li>
                                <li>Unexpected deterioration of the security situation in the project region due to
                                    conflicts between and within communities</li>
                                <li>Protection concerns, harassment and sexual abuse of children in project areas and
                                    among staff</li>
                                <li>Unacceptable expectations of the ruling elite, lack of cooperation and interference
                                    in targeting and implementation of activities</li>
                                <li>Mismanagement of project funds and the risk of corruption/fraud</li>
                                <li>Hazards, extreme weather events including risks of flash floods, earthquakes and
                                    landslides</li>
                                <li>The Covid 19 pandemic is causing contagion among project beneficiaries, project
                                    staff and other stakeholders; combined with government restrictions on movement,
                                    this is leading to access problems and long project delays.
                                </li>

                            </ul>
                        </li>
                        </li>
                    </ul>
                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Participant narrative</label>

                        <li class="firstList"> </li>
                        <li>
                            <p><strong>Direct beneficiaries:</strong><br /> The beneficiary households for project
                                interventions are
                                identified on the basis of vulnerability criteria defined together with the local
                                communities. Preference is given not only to family members who are physically
                                vulnerable to malnutrition, but also to socially marginalised and particularly poor
                                households in the region, i.e. smallholder* farmers (< 0.125 acres of land ownership),
                                    resource-poor female-headed households, unemployed youth, families of landless and
                                    labourers, persons with special needs (e.g. the elderly and minors, persons with
                                    disabilities, families of mine workers, families of women farmers (< 0.125 acres of
                                    land ownership).e.g. elderly and minors, persons with disabilities), families of
                                    mine workers (many men from extremely poor Shangla families work in mines in Sindh
                                    and Punjab, these households are often headed by women) and religious minorities
                                    (Hindus, Christians). </p>
                                    <p><strong>Indirect beneficiaries</strong> <br>Indirect beneficiaries are the entire
                                        population of 15 Village Councils of Besham
                                        and Pattan Tehsils (115,000) as the multiplier effects of the project would
                                        result in significant direct and indirect benefits to them. Positive impacts
                                        will be: school-going children, farmers/women farmers reached through farmer
                                        field days, improved agricultural practices and services related to crops and
                                        livestock, specially developed information, education and communication (IEC)
                                        materials to promote improved nutrition and health practices, improved access to
                                        clean water and sanitation, improved income generation and market services.
                                        Close cooperation is envisaged with local authorities other than government
                                        departments, civil society actors, provincial level actors and national actors
                                        to exploit synergies and enhance the various positive impacts of the projects.
                                    </p>
                        </li>
                    </ul>


                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Objectives / Impact, outcome</label>

                        <li class="firstList"></li>
                        <li>
                            <p class="mb-0"><strong>Overall objective (impact):</strong> To contribute to the
                                eradication of poverty and hunger in Tehsil Pattan (Lower Kohistan) and Tehsil Besham
                                (Shangla) for a resilient society where women and children are optimally nourished.</p>
                            <p><strong>Project objective (result/outcome):</strong> Improved food security of 8,000
                                households in Tehsil Pattan (Lower Kohistan) and Tehsil Besham (Shangla)</p>
                        </li>
                    </ul>

                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Output</label>

                        <li class="firstList"></li>
                        <li>
                            <p class="mb-0">Output 1: <br>Farming families from the target HHs increase and diversify
                                crop and livestock production</p>
                            <p class="mb-0">Output 2: <br>
                                Youth and vulnerable families have improved & diversified income opportunities (on- &
                                off- farm)</p>
                            <p class="mb-0">Output 3: <br>
                                Target households have access to safe water and sanitation and have improved their
                                health, hygiene and nutrition knowledge and practices.</p>
                            <p class="mb-0">
                                Output 4: <br>
                                The Multisectoral Integrated Nutrition Strategy (MINS) of Khyber Pakhtunkhwa Province in
                                Tehsils Besham (Shangla) and Pattan (Lower Kohistan) is being implemented.
                            </p>
                            <p class="mb-0">
                                Output 5: <br>
                                The organisational capacities of the two local project partners are strengthened for
                                results-oriented programming in nutrition.
                            </p>
                        </li>
                    </ul>


                    <ul class="navbar-nav bg-light">
                    <label class="control-label text-muted">Assumptions</label>

                        <li class="firstList"> </li>
                        <li>

                            <p>
                                Early Partnership Agreements - MOU (LASOONA, NIDA and WHH) with EAD and MOI and
                            project-specific No-objection Certificate (NOC) from the Provincial Planning and Development
                            Department are recieved well in time. <br>

                            Cultural constraints on women's participation and their negative impact on women's role in
                            the family do not create mistrust between family members <br>

                            No unexpected deterioration of the security situation in the project region due to conflicts
                            between and within communities <br>

                            No protection concerns, harassment and sexual abuse of children in project areas and among
                            staff <br>

                            No unacceptable expectations of the ruling elite, lack of cooperation and interference in
                            targeting and implementation of activities <br>

                            No mismanagement of project funds and the risk of corruption/fraud <br>

                            No hazards, extreme weather events including risks of flash floods, earthquakes and
                            landslides <br>

                            Elections of local government takes place in the first year of the project
                            </p>


                        </li>
                    </ul>



                </div>
            </div>

        </div>





        <!-- <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                 <a class="navbar-brand" href="#">Hidden brand</a> 
                 <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> 
                <div class="flex flex-wrap" id="navbarTogglerDemo01">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link fontSizeInNav" href="#">OVERVIEW</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">DOCUMENT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">FINANCE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">TASKS/MILSTONES</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">PROJECT SUMMERY</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">LOGFRAME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">PARTICIPANTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">AGREEMENTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">MEMEBERS</a>
                        </li>
    
                        <li class="nav-item">
                            <a class="nav-link fontSizeInNav" href="#">PROJECT CHANGES</a>
                        </li>
                    </ul>
    
                </div>
            </div>
        </nav> -->
    </div>







            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#edit_project').click(function(){
			uni_modal("Update Project Details","projects/manage_project.php?id=<?= isset($id) ? $id : '' ?>")
		})
        $('#delete_project').click(function(){
			_conf("Are you sure to delete this project?","delete_project",["<?= isset($id) ? $id : '' ?>"])
		})
        $('#close_project').click(function(){
			_conf("Are you sure to close this project?","close_project",["<?= isset($id) ? $id : '' ?>"])
		})
        $('.view_data').click(function(){
			uni_modal("Report Details","projects/view_report.php?id="+$(this).attr('data-id'),"mid-large")
		})
        $('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
    })
    function close_project($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=close_project",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
    function delete_project($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_project",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.href="./?page=projects";
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
