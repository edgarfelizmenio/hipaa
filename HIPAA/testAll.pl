:- ['HIPAA.pl'].

inRole(ce, covered_entity).
inRole(ce2, covered_entity).
inRole(ce3, covered_entity).

inRole(patient, individual).
inRole(patient, adult).
inRole(assistant, secretary).
inRole(lawyer, legal_attorney).
inRole(cop, law_enforcement_officer).
inRole(thief, suspected_crime_perpetrator).
inRole(doctor, healthCare_provider).
inRole(nurse, healthCare_provider).

inRole(hcp, healthCare_provider).
inRole(gahp, government_agency_health_plan).
inRole(kid, unemancipated_minor).
inRole(dead, deceased_individual).
inRole(hp, health_plan).
inRole(hoa, health_oversight_agency).
inRole(pha, public_health_authority).
inRole(hcao, healthCare_accreditation_organization).

employee_of(doctor, ce).
employee_of(nurse, ce).

minimum( phi, surgery).

parent(kid, mom).
guardian(kid, dad).
loco_parentis(kid, momdad).

personal_representative(patient, elder).
personal_representative(dead,executor).

%verify how this is written!! this works!!
business_associate(ba, ce).

in_relation(patient, ce3).

relationship(mom,x,y).


t :-
  t_164_502_d_1.

test :-
  t_164_502,
  t_164_506.

t_164_502 :-
  t_164_502_a_1_i,
  t_164_502_a_1_ii,
  t_164_502_a_1_iii,
  t_164_502_a_1_iv,
  t_164_502_a_1_v,
  t_164_502_a_1_vi,
  t_164_502_a_2_i,
  t_164_502_a_2_ii,
  t_164_502_b_1,
  t_164_502_b_2_ia,
  t_164_502_b_2_ii,
  t_164_502_b_2_iii,
  t_164_502_b_2_iv,
  t_164_502_b_2_v,
  t_164_502_b_2_vi,
  t_164_502_d_1,
  t_164_502_d_2,
  t_164_502_e_ia,
  t_164_502_e_ib,
  t_164_502_e_ic,
  t_164_502_e_id,
  t_164_502_e_ii_a,
  t_164_502_e_ii_b,
  t_164_502_e_ii_c,
  t_164_502_f,
  t_164_502_g_1,
  t_164_502_g_2,
  t_164_502_g_3_ia,
  t_164_502_g_3_ib,
  t_164_502_g_3_ic,
  t_164_502_g_3_ii,
  t_164_502_g_4,
  t_164_502_g_5,
  t_164_502_ha,
  t_164_502_hb,
  t_164_502_i,
  t_164_502_j_1_ii_Aa,
  t_164_502_j_1_ii_Ab,
  t_164_502_j_1_ii_Ac,
  t_164_502_j_1_ii_B,
  t_164_502_j_2.

t_164_506 :-
  t_164_506_ac1a,
  t_164_506_ac1b,
  t_164_506_ac1c,
  t_164_506_ac2,
  t_164_506_ac3a,
  t_164_506_ac3b,
  t_164_506_ac4,
  t_164_506_c_1a,

  t_164_506_c_1b,
  t_164_506_c_1c,
  t_164_506_c_2,
  t_164_506_c_3a,
  t_164_506_c_3b,
  t_164_506_c_4.


t_164_502_a_1_i :-
  pbh(a(patient, ce, patient, phi, null, null, null,null)),
  not(pbh(a(hp, ce, hp, phi, null, null, null,null))),
  not(pbh(a(patient, ce, elder, phi, null, null, null,null))),
  writeln('t_164_502_a_1_i passed').



t_164_502_a_1_ii :-

  true.

  %test 164_506 covers all the cases

%%%%Test is not complete. It only checks for all the true conditions.

t_164_502_a_1_iii :-
  %pbh(a(null, ce, patient, phi, incident_to_use, null, null)).
  true.
  % need to write others ( 164_502_b(A), 164_514_d(A),164_530_c(A) ) first

t_164_502_a_1_iv :-
  %pbh(a(null, ce, patient, phi, null, null, null)).
  true.
  %need to write authorization part (164_508) first

t_164_502_a_1_v :-
  %pbh(a(null, ce, patient, phi, null, null, null)).
  true.
  %need to write 510 first

t_164_502_a_1_vi :-
  %pbh(a(null, ce, patient, phi, null, null, null)).
  true.
  %need to write others (164_512(A),164_514_e(A), 164_514_f(A), 164_514_g) first

t_164_502_a_2_i :-
  %pbh(a(null, ce, patient, phi, null, a(null,null,null,null,requested_by_Individual,null,null), null)).
  true.
  % need to write others (164_524,164_528) first

t_164_502_a_2_ii :-
  %pbh(a(assistant, ce, patient, phi, investigate, null, null)).
  true.
  %need to write others (160_C) first

t_164_502_b_1 :-
   pbh(a(ce, ce2, null, null, null,null, null,b(null,minimum_necessary_to_purpose,ce2))),
   not(pbh(a(patient, ce2, null, null, null,null, null,b(null,minimum_necessary_to_purpose,ce2)))),
   not(pbh(a(ce, lawyer, null, null, null,null, null,b(null,minimum_necessary_to_purpose,ce2)))),
   not(pbh(a(ce2, ce3, null, null, null,null, null,null))),
    writeln('t_164_502_b_1 passed').


t_164_502_b_2_ia :-
   pbh(a(hcp, null, null, null, treatment,null, null,null)),
   writeln('t_164_502_b_2_ia passed'),
   not(pbh(a(hcp, null, null, null, null,null, null,null))),
   writeln('t_164_502_b_2_ia passed'),
   not(pbh(a(null, null, kid, null, treatment,null, null,null))),
   writeln('t_164_502_b_2_ia passed').



t_164_502_b_2_ii :- 
  true.
  %will be tested by 164_502_a_1_i(A) and 164_502_a_2_i

t_164_502_b_2_iii :- 
  pbh(a(null, null, null, null, obtaining_authorization, null, null, null)),
  not(pbh(a(null, null, null, null, null, null, null, null))),
  writeln('t_164_502_b_2_iii passed').
  

t_164_502_b_2_iv :- 
  %pbh(a(assistant, null, null, null, null, null, null)).
  true.
  %need to write 160 C first 

t_164_502_b_2_v :- 
  true.
  %512 not implemented

t_164_502_b_2_vi :- 
  true.
  %need to write 164_502_a_2 first 



%test c would be checked by a

t_164_502_d_1 :-
   pbh(a(ba, ce, null, phi, create_deidentified_info, null, null, null)),
   not(pbh(a(patient, ce, null, phi, create_deidentified_info, null, null, null))),
   not(pbh(a(ba, patient, null, phi, create_deidentified_info, null, null, null))),
   not(pbh(a(ba, ce, null, null, create_deidentified_info, null, null, null))),
   not(pbh(a(ba, ce, null, phi, null, null, null, null))),
  writeln('t_164_502_d_1 passed').



t_164_502_d_2 :- 
  true.
  %not implemented


t_164_502_e_ia :-
  pbh(a(ba, ce, null, phi, create_protected_health_info, null, null, b(ce, lawful_business_associate, ba))),
  not(pbh(a(lawyer, ce, null, phi, create_protected_health_info, null, null, null))),
  not(pbh(a(ba, lawyer, null, phi, create_protected_health_info, null, null, null))),
  not(pbh(a(ba, ce, null, null, create_protected_health_info, null, null, null))),
  not(pbh(a(ba, ce, null, phi, null, null, null, null))),
  writeln('164_502_e_ia passed').
 

t_164_502_e_ib :-
  pbh(a(ce, ba, null, phi, create_protected_health_info, null, null, b(ce, lawful_business_associate, ba))),
  not(pbh(a(lawyer, ba, null, phi, create_protected_health_info, null, null, null))),
  not(pbh(a(ce, lawyer, null, phi, create_protected_health_info, null, null, null))),
  not(pbh(a(ce, ba, null, null, create_protected_health_info, null, null, null))),
  not(pbh(a(ce, ba, null, phi, null, null, null, null))),
  writeln('164_502_e_ib passed').

t_164_502_e_ic :-
  pbh(a(ba, ce, null, phi, receive_protected_health_info, null, null, b(ce, lawful_business_associate, ba))),
  not(pbh(a(lawyer, ce, null, phi, receive_protected_health_info, null, null, null))),
  not(pbh(a(ba, lawyer, null, phi, receive_protected_health_info, null, null, null))),
  not(pbh(a(ba, ce, null, null, receive_protected_health_info, null, null, null))),
  writeln('164_502_e_ic passed').

t_164_502_e_id :-
  pbh(a(ce, ba, null, phi, receive_protected_health_info, null, null, b(ce, lawful_business_associate, ba))),
  not(pbh(a(lawyer, ba, null, phi, receive_protected_health_info, null, null, null))),
  not(pbh(a(ce, lawyer, null, phi, receive_protected_health_info, null, null, null))),
  not(pbh(a(ce, ba, null, null, receive_protected_health_info, null, null, null))),
  writeln('164_502_e_id passed').




t_164_502_e_ii_a :-
  pbh(a(hcp, ce, patient, phi, treatment, null, null, null)),
  writeln('t_164_502_e_ii_a passed').

t_164_502_e_ii_b :-  
  true.
  %504 not implemented

t_164_502_e_ii_c :-
  pbh(a(null, gahp, null, null, enrollment, null, null,null)),
  writeln('t_164_502_e_ii_c passed').


t_164_502_f :- 
  true.
  %not done


t_164_502_g_1 :- %not implemented tricky but interesting
  %pbh(a(t, null, ab, null, null, null, null)),
  %personal_representative(ab, t).
  true.

personal_representative(minors_rep, minor).
t_164_502_g_2 :-
  pbh(a(elder, null, patient, null, null, null, null, null)),
  pbh(a(null,elder, patient, null, null, null, null, null)),
  not(pbh(a(null,null, patient, null, null, null, null, null))),
  not(pbh(a(null,elder, null, null, null, null, null, null))),
  not(pbh(a(minors_rep, null, minor, null, null, null, null, null))),
  writeln('t_164_502_g_2 passed').


t_164_502_g_3_ia :- 
  %pbh(a(mom, null, kid, null, null, null, null))
  true.
  %A B c not done

t_164_502_g_3_ib :- 
  %pbh(a(dad, null, kid, null, null, null, null)).
  true.
  %A B c not done

t_164_502_g_3_ic :- 
  %pbh(a(momdad, null, kid, null, null, null, null)).
  true.   
  %A B c not done
  
t_164_502_g_3_ii :-  
  true.
  %not done

personal_representative(alives_rep,alive).

t_164_502_g_4 :- 
  pbh(a(executor, null, dead, null, null, null, null, null)),
  pbh(a(null, executor, dead, null, null, null, null, null)),
  not(pbh(a(null, patient, dead, null, null, null, null, null))),
  not(pbh(a(null, executor, patient, null, null, null, null, null))),
  not(pbh(a(alives_rep, null, alive, null, null, null, null, null))),
  writeln('t_164_502_g_4 passed').


t_164_502_g_5 :- 
  true.
  %not done belief not in best interest

t_164_502_ha :- 
  %pbh(a(null, hcp, null, phi, null, null, null)).
  true.
  %not done 522

t_164_502_hb :- 
  %pbh(a(null, hp, null, phi, null, null, null)).
  true.
  %not done 522

t_164_502_i :- 
  true.
  %not done

t_164_502_j_1_i :- 

 % is covered in t_164_502_j_1_ii 

true.


t_164_502_j_1_ii_Aa :- 
  pbh(a(hoa, ba, null, null, null, null, null, b(ce,unlawful_covered_entity,ba))),
  not(pbh(a(null, ba, null, null, null, null, null, b(ce,unlawful_covered_entity,ba)))),
  not(pbh(a(null, nurse, null, null, null, null, null, b(ce,unlawful_covered_entity,ba)))),
  not(pbh(a(hoa, ba, null, null, null, null, null, b(null,unlawful_covered_entity,ba)))),
  not(pbh(a(hoa, ba, null, null, null, null, null, b(ce,unlawful_covered_entity,null)))),
  writeln('t_164_502_j_1_ii_Aa passed').


t_164_502_j_1_ii_Ab :- 
  pbh(a(pha, ba, null, null, investigate, null, null, b(ce,unlawful_covered_entity,ba))),
  not(pbh(a(null, ba, null, null, investigate, null, null, b(ce,unlawful_covered_entity,ba)))),
  not(pbh(a(pha, patient, null, null, investigate, null, null, b(ce,unlawful_covered_entity,patient)))),
  not(pbh(a(pha, ba, null, null, null, null, null, b(ce,unlawful_covered_entity,ba)))),
  not(pbh(a(pha, ba, null, null, investigate, null, null, b(ce2,unlawful_covered_entity,ba)))),
  not(pbh(a(pha, ba, null, null, investigate, null, null, b(ce,null,ba)))),
  not(pbh(a(pha, ba, null, null, investigate, null, null, b(ce,unlawful_covered_entity,null)))),
  writeln('t_164_502_j_1_ii_Ab passed').



t_164_502_j_1_ii_Ac :- 
  pbh(a(hcao, ba, null, null, standards_failure_misconduct, null, null, b(ce,unlawful_covered_entity,ba))),
  not(pbh(a(null, ba, null, null, standards_failure_misconduct, null, null, b(ce,unlawful_covered_entity,ba)))), 
  not(pbh(a(hcao, patient, null, null, standards_failure_misconduct, null, null, b(ce,unlawful_covered_entity,patient)))), 
  not(pbh(a(hcao, ba, null, null, null, null, null, b(ce,unlawful_covered_entity,ba)))), 
  not(pbh(a(hcao, ba, null, null, standards_failure_misconduct, null, null, b(ce2,unlawful_covered_entity,ba)))), 
  not(pbh(a(hcao, ba, null, null, standards_failure_misconduct, null, null, b(ce,unlawful_covered_entity,patient)))), 
  not(pbh(a(hcao, ba, null, null, standards_failure_misconduct, null, null, b(ce,null,patient)))),
  writeln('t_164_502_j_1_ii_Ac passed').


t_164_502_j_1_ii_B :- 
  pbh(a(lawyer, ba, null, null, determining_legal_options, null, null, b(ce,unlawful_covered_entity,ba))),
  not(pbh(a(null, ba, null, null, determining_legal_options, null, null, b(ce,unlawful_covered_entity,ba)))),
  not(pbh(a(lawyer, patient, null, null, determining_legal_options, null, null, b(ce,unlawful_covered_entity,patient)))),
  not(pbh(a(lawyer, ba, null, null, null, null, null, b(ce,unlawful_covered_entity,ba)))),
  not(pbh(a(lawyer, ba, null, null, determining_legal_options, null, null, b(ce,unlawful_covered_entity,patient)))),
  not(pbh(a(lawyer, ba, null, null, determining_legal_options, null, null, b(ce2,unlawful_covered_entity,ba)))),
  not(pbh(a(lawyer, ba, null, null, determining_legal_options, null, null, b(ce,null,ba)))),
  writeln('t_164_502_j_1_ii_B passed').


t_164_502_j_2 :- 
  %pbh(a(cop, doctor, thief, phi, null, null, null)).
  true.
   %512 not implemented

t_164_506_ac1a :-
  %pbh(a(nurse, doctor, patient, phi, payment, null, null)).
  % need to write 164_508 first
  true.

t_164_506_ac1b :-
  %pbh(a(nurse, doctor, patient, phi, treatment, null, null)).
  % need to write 164_508 first
  true.

t_164_506_ac1c :-
  %pbh(a(nurse, doctor, patient, phi, healthCare_operations, null, null)).
  % need to write 164_508 first
  true.

t_164_506_ac2 :-
  %pbh(a(hcp, ce, patient, phi, treatment, null, null)).
  % need to write 164_508 first
  true. 

t_164_506_ac3a :-
  %pbh(a(hcp, ce, patient, phi, payment, null, null)).
  % need to write 164_508 first
  true.

t_164_506_ac3b :-
  % pbh(a(ce2, ce, patient, phi, payment, null, null)).
  % need to write 164_508 first
  true.

t_164_506_ac4 :-
  %pbh(a(ce3, ce, patient, phi, healthCare_operations, null, null)).
   % need to write 164_508 first
   true.


employee_of(secr, ce).

t_164_506_c_1a :-
  pbh(a(doctor, nurse, patient, phi, treatment, null, null,null)),
  not(pbh(a(secr, nurse, patient, null, treatment, null, null,null))),
  not(pbh(a(secr, nurse, patient, phi, null, null, null,null))),
  not(pbh(a(secr, lawyer, patient, phi, treatment, null, null,null))),
  writeln('t_164_502_c_1a passed').

t_164_506_c_1b :-
  pbh(a(doctor, nurse, patient, phi, payment, null, null,null)),
  not(pbh(a(secr, nurse, patient, null, payment, null, null,null))),
  not(pbh(a(secr, lawyer, patient, phi,payment, null, null,null))),
  writeln('t_164_502_c_1b passed').

t_164_506_c_1c :-
  pbh(a(doctor, nurse, patient, phi, healthCare_operations, null, null,null)),
  not(pbh(a(secr, nurse, patient, null, healthCare_operations, null, null,null))),
  not(pbh(a(secr, lawyer, patient, phi,healthCare_operations, null, null,null))),
  writeln('t_164_502_c_1c passed').

t_164_506_c_2 :-
  pbh(a(hcp, null, patient, phi, treatment, null, null,null)),
  not(pbh(a(hcp, null, patient, phi, null, null, null,null))),
  not(pbh(a(secr, null, patient, phi, treatment, null, null,null))),
  writeln('t_164_502_c_2 passed').

t_164_506_c_3a :-
  pbh(a(hcp, null, null, phi, payment, null, null, null)),
  not(pbh(a(hcp, null, null, phi, null, null, null, null))),
  not(pbh(a(lawyer, null, patient, phi, payment, null, null, null))),
  writeln('t_164_502_3_3a passed').

t_164_506_c_3b :-
  pbh(a(ce2, null, patient, phi, payment, null, null,null)),
  not(pbh(a(ce2, null, patient, null, payment, null, null,null))),
  not(pbh(a(ce2, null, patient, phi, null, null, null,null))),
  not(pbh(a(assistant, null, patient, phi, payment, null, null,null))),
  writeln('t_164_506_c_3b passed').


% c4 currently not working since you need a list of purposes. Right now it's just one purpose.
t_164_506_c_4 :-
  true.
  %pbh(a(ce3, ce, patient, phi, healthCare_operations, null, null,null)),
  % pbh(a(ce3, ce, patient, phi, healthCare_fraud_abuse_detection
  %, null, null,null)).

