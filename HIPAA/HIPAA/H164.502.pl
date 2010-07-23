
%uses and disclosure of PHI

:- ['H164.502.a.pl'].
:- ['H164.502.b.pl'].
:- ['H164.502.c.pl'].
:- ['H164.502.d.pl'].
:- ['H164.502.e.pl'].
:- ['H164.502.f.pl'].
:- ['H164.502.g.pl'].
:- ['H164.502.h.pl'].
:- ['H164.502.i.pl'].
:- ['H164.502.j.pl'].

permitted_by_164_502(A):-                
  permitted_by_164_502_a(A);
  permitted_by_164_502_b(A);	%must satisfy
  permitted_by_164_502_c(A);
  permitted_by_164_502_d(A);
  permitted_by_164_502_e(A);	%must satisfy
  permitted_by_164_502_f(A);
  permitted_by_164_502_g(A);
  permitted_by_164_502_h(A);
  permitted_by_164_502_i(A);
  permitted_by_164_502_j(A).

forbidden_by_164_502(A):-                
  forbidden_by_164_502_a(A);
  forbidden_by_164_502_b(A);
  forbidden_by_164_502_c(A);
  forbidden_by_164_502_d(A);
  forbidden_by_164_502_e(A);
  forbidden_by_164_502_f(A);
  forbidden_by_164_502_g(A);
  forbidden_by_164_502_h(A);
  forbidden_by_164_502_i(A);
  forbidden_by_164_502_j(A).

