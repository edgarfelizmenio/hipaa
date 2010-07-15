permitted_by_13405_b(A) :- 
  %is_minimum_necessary(A).
  is_belief_from_minimum(A),
  writeln('HITECH rule 13405;').

forbidden_by_13405_d(A) :- 
  is_for_health_record_sale(A),
  writeln('HITECH rule 13405 forbids;').
