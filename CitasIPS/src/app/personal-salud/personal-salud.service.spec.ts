import { TestBed } from '@angular/core/testing';

import { PersonalSaludService } from './personal-salud.service';

describe('PersonalSaludService', () => {
  let service: PersonalSaludService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(PersonalSaludService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
