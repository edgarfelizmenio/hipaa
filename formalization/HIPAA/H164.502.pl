
%uses and disclosure of PHI

:- ['./HIPAA/H164.502.a.pl'].
:- ['./HIPAA/H164.502.b.pl'].
:- ['./HIPAA/H164.502.c.pl'].
:- ['./HIPAA/H164.502.d.pl'].
:- ['./HIPAA/H164.502.e.pl'].
:- ['./HIPAA/H164.502.f.pl'].
:- ['./HIPAA/H164.502.g.pl'].
:- ['./HIPAA/H164.502.h.pl'].
:- ['./HIPAA/H164.502.i.pl'].
:- ['./HIPAA/H164.502.j.pl'].

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

