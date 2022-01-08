import { TestBed } from '@angular/core/testing';

import { RegistroCitasService } from './registro-citas.service';

describe('RegistroCitasService', () => {
  let service: RegistroCitasService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RegistroCitasService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
