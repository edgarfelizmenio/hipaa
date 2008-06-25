%%Example system
:- ['HIPAA.pl'].
inRole(hcp, healthCare_provider).
inRole(hoa, health_oversight_agency).
inRole(pha, public_health_authority).
inRole(hcao, healthCare_accreditation_organization).
inRole(hp, health_plan).
inRole(ghp, group_health_plan).

inRole(gahp, government_agency_health_plan).
inRole(hii, health_insurance_issuer).
inRole(hcch, healthCare_clearing_house).
	
inRole(ce, covered_entity).
inRole(ce2, covered_entity).

inRole(ba, entity).

%inRole(doctor, covered_entity).
inRole(doctor, healthCare_provider).
inRole(doctor, adult).
%inRole(nurse, covered_entity).
inRole(nurse, healthCare_provider).
inRole(nurse, adult).

inRole(assistant, secretary).
inRole(assistant, adult).
inRole(lawyer, legal_attorney).
inRole(lawyer, adult).

inRole(patient, individual).
inRole(patient, adult).
inRole(cop, law_enforcement_officer).
inRole(cop, individual).
inRole(cop, adult).
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


%meaningless right now.
employee_of(doctor, ce).
employee_of(nurse, ce).
employee_of(assistant, ce).
employee_of(lawyer, ce).

%Purposes of specifics.
purpose( surgery, treatment).
%minimum necessary or less.
minimum( phi, payment).

%business_assocate(X,Y):  Y is a business associate of X.
business_associate(ba, ce).

in_relation(teen, ce2).

personal_representative(dead, patient).
personal_representative(thief, teen).
parent(kid, mom).
parent(kid,doctor).
personal_representative(teen, dad).
personal_representative(doctor, thief).
loco_parentis(kid, lawyer).

test :-
pbh(a(mom,nurse,assistant,phi,treatment,null,null)).
test :-
  pbh(a(mom,nurse,kid,phi,treatment,null,null)).
test :-
  pbh(a(lawyer,nurse,kid,phi,treatment,null,null)).
test :-
  pbh(a(teen,nurse,thief,phi,treatment,null,null)).
test :-
  pbh(a(patient,nurse,dead,phi,treatment,null,null)).
test :-
  pbh(a(dad,nurse,teen,phi,treatment,null,null)).
test :-
  pbh(a(thief,nurse,doctor,phi,treatment,null,null)).
test :-
  pbh(a(o,m,dad,phi,create_protected_health_info,null,null)).
test :-
  pbh(a(m,o,dad,phi,create_protected_health_info,null,null)).
test :-
  pbh(a(m,o,dad,phi,create_protected_health_info,null,null)).

