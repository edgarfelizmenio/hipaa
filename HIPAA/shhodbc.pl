%%Example system
:- ['HIPAA.pl'].
:- ['myfunc.pl].

%% inRole predicates
:- assert_in_role(_).

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
  pbh(a(seattle_grace_hospital,sacred_heart_hospital,patient,phi,null,null,null,b(null,minimum_necessary_to_purpose,sacred_heart_hospital))).
test :-
  pbh(a(ted,lavern,patient,phi,determining_legal_options,null,null,b(sacred_heart_hospital,unlawful_covered_entity,lavern))).
test :-
  pbh(a(dr_jd,dr_elliot,patient,phi,treatment,null,null,null)).
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

