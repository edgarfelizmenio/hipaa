%%Example system
:- ['pbh.pl'].
:- ['myfunc.pl'].
inRole(sacred_heart_hospital, covered_entity).
inRole(business_associate, covered_entity).

inRole(chief_of_medicine, healthCare_provider).
inRole(doctor, healthCare_provider).
inRole(surgeon, healthCare_provider).
inRole(intern, healthCare_provider).
inRole(nurse, healthCare_provider).
inRole(volunteer, healthCare_provider).
inRole(trainee, healthCare_provider).

inRole(dr_cox, doctor).
inRole(dr_kelso, chief_of_medicine).
inRole(dr_turk, surgeon).
inRole(dr_jd, intern).
inRole(dr_elliot, intern).
inRole(carla, nurse).
inRole(lavern, secretary).
inRole(ted, legal_attorney).
inRole(j, janitor).
inRole(jordon, board_member).

inRole(dr_cox, adult).
inRole(dr_cox, individual).
inRole(dr_kelso, adult).
inRole(dr_kelso, individual).
inRole(dr_turk, adult).
inRole(dr_turk, individual).
inRole(dr_jd, adult).
inRole(dr_jd, individual).
inRole(dr_elliot, adult).
inRole(dr_elliot, individual).
inRole(carla, adult).
inRole(carla, individual).
inRole(lavern, adult).
inRole(lavern, individual).
inRole(ted, adult).
inRole(ted, individual).
inRole(j, adult).
inRole(j, individual).
inRole(jordon, adult).
inRole(jordon, individual).


inRole(seattle_grace_hospital, covered_entity).
%inRole(the_office, entity).
inRole(hcp, healthCare_provider).
inRole(hoa, health_oversight_agency).
inRole(pha, public_health_authority).
inRole(hcao, healthCare_accreditation_organization).
inRole(hp, health_plan).
inRole(ghp, group_health_plan).

inRole(gahp, government_agency_health_plan).
inRole(hii, health_insurance_issuer).
inRole(hcch, healthCare_clearing_house).
	
inRole(patient, individual).
inRole(patient, adult).
inRole(thief, suspected_crime_perpetrator).
inRole(thief, individual).
inRole(thief, adult).
inRole(teen, emancipated_minor).
inRole(teen, individual).
inRole(kid, unemancipated_minor).
inRole(kid, individual).
inRole(mom, individual).
inRole(mom, adult).
inRole(dad, individual).
inRole(dad, adult).
inRole(dead, deceased_individual).
inRole(dead, individual).
inRole(dead, adult).
inRole(clergy_mem,clergy).

inRole(cop, law_enforcement_officer).
inRole(government_official, government_secretary).

%%relations
employee_of(dr_cox, sacred_heart_hospital).
employee_of(dr_kelso, sacred_heart_hospital).
employee_of(dr_turk, sacred_heart_hospital).
employee_of(dr_jd, sacred_heart_hospital).
employee_of(dr_elliot, sacred_heart_hospital).
employee_of(carla, sacred_heart_hospital).
employee_of(lavern, sacred_heart_hospital).
employee_of(ted, sacred_heart_hospital).
employee_of(j, sacred_heart_hospital).
employee_of(jordon, sacred_heart_hospital).

%Purposes of specifics.
purpose( surgery, treatment).

%business_assocate(X,Y):  Y is a business associate of X.
business_associate(the_office, sacred_heart_hospital).
business_associate(patient_safety_organization, sacred_heart_hospital).
business_associate(subcontractor, business_associate).
business_associate(health_information_exchange_organization, sacred_heart_hospital).
business_associate(E-prescribing_gateway, sacred_heart_hospital).
business_associate(regional_health_information_organization, sacred_heart_hospital).


in_relation(mom, seattle_grace_hospital).

personal_representative(dead, patient).
parent(kid, mom).
parent(kid, dad).
personal_representative(teen, dad).
personal_representative(teen, mom).
personal_representative(dad, mom).
personal_representative(mom, dad).
guardian(null, null).
loco_parentis(null, null).

relationship(mom, relative, teen).
involved(dad,payment,kid). 

test :-
  pbh(a(dr_cox,carla,carla,phi,create_deidentified_info,null,null,null)).

test :-
  pbh(a(dr_jd,dr_elliot,patient,phi,treatment,null,null,null)).
test :-
  writeln('First test;'),
  pbh(a(seattle_grace_hospital,null,patient,phi,health_record_sale,null,null,b(null,minimum_necessary_to_purpose,sacred_heart_hospital))).
test :-
  writeln('Second test;'),
  pbh(a(ted,lavern,patient,phi,determining_legal_options,null,null,b(sacred_heart_hospital,unlawful_covered_entity,lavern))).
test :-
  pbh(a(seattle_grace_hospital,sacred_heart_hospital,patient,phi,null,null,null,b(null,minimum_necessary_to_purpose,sacred_heart_hospital))).
test :-
  pbh(a(mom,carla,kid,phi,null,null,null,null)).
test :-
  pbh(a(ted,carla,kid,phi,payment,null,null,null)).
test :-
  pbh(a(teen,carla,thief,phi,treatment,null,null,null)).
test :-
  pbh(a(patient,carla,dead,phi,treatment,null,null,null)).
test :-
  pbh(a(dad,carla,teen,phi,treatment,null,null,null)).
test :-
  pbh(a(thief,carla,dr_kelso,phi,treatment,null,null,null)).
test :-
  pbh(a(seattle_grace_hospital,sacred_heart_hospital,dad,phi,create_protected_health_info,null,null,null)).
test :-
  pbh(a(sacred_heart_hospital,seattle_grace_hospital,dad,phi,create_protected_health_info,null,null,null)).
test :-
  pbh(a(sacred_heart_hospital,seattle_grace_hospital,dad,phi,create_protected_health_info,null,null,null)).

