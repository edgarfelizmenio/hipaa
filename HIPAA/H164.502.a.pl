
:- ['H160.C.pl'].
:- ['H164.506.pl'].
:- ['H164.514.pl'].
:- ['H164.512.pl'].
:- ['H164.510.pl'].
:- ['H164.528.pl'].
:- ['H164.530.pl'].
:- ['H164.524.pl'].

%%Standard rules for "uses and disclosures"
permitted_by_164_502_a(A) :-
  is_from_coveredEntity(A),
  is_phi(A),
  (permitted_by_160_C(A);
  permitted_by_164_502_a_1(A);
  required_by_164_502_a_2(A)).

permitted_by_164_502_a_1(A):-                
  permitted_by_164_502_a_1_i(A);
  permitted_by_164_502_a_1_ii(A);
  permitted_by_164_502_a_1_iii(A);
  permitted_by_164_502_a_1_iv(A);
  permitted_by_164_502_a_1_v(A);
  permitted_by_164_502_a_1_vi(A).

permitted_by_164_502_a_1_i(A):-
  is_to_concernedIndividual(A),
  writeln('HIPAA rule 164_502_a_1_i;').

permitted_by_164_502_a_1_ii(A):-
  is_for_eitherPurpose(A),
  permitted_by_164_506(A),              
  writeln('HIPAA rule 164_502_a_1_ii;').

permitted_by_164_502_a_1_iii(A):-
  is_for_incidentToUse(A),
  permitted_by_164_502_b(A),   
  permitted_by_164_514_d(A),   
  permitted_by_164_530_c(A),              
  writeln('HIPAA rule 164_502_a_1_iii;').

permitted_by_164_502_a_1_iv(A):-
  require_authorization_by_164_508(A),
  writeln('HIPAA rule 164_502_a_1_iv;').

permitted_by_164_502_a_1_v(A):-
  permitted_by_164_510(A),                  
  writeln('HIPAA rule 164_502_a_1_v;').

permitted_by_164_502_a_1_vi(A):-
  permitted_by_164_512(A);
  permitted_by_164_514_e(A);
  permitted_by_164_514_f(A);
  permitted_by_164_514_g(A).

%required by!! 
required_by_164_502_a_2(A):-   
  required_by_164_502_a_2_i(A);
  required_by_164_502_a_2_ii(A).

required_by_164_502_a_2_i(A):-
  is_to_concernedIndividual(A),
  is_replyTo_request(A),
  (required_by_164_524(A);
  required_by_164_528(A)),
  writeln('HIPAA rule 164_502_a_2_i;').

required_by_164_502_a_2_ii(A):-
   is_to_secretary(A),
   is_for_investigation(A),
   permitted_by_160_C(A),
   writeln('HIPAA rule 164_502_a_2_ii;').


