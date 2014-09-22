/*     */ package protocol;
/*     */ 
/*     */ import com.goldhuman.Common.Octets;
/*     */ import com.goldhuman.IO.PollIO;
/*     */ import com.goldhuman.IO.Protocol.Rpc;
/*     */ import com.goldhuman.IO.Protocol.Rpc.Data.DataVector;
/*     */ import java.io.PrintStream;
/*     */ 
/*     */ public class GameDB
/*     */ {
/*     */   public static final int LEVEL = 1;
/*     */   public static final int EXP = 2;
/*     */   public static final int POCKET_MONEY = 4;
/*     */   public static final int STORE_MONEY = 8;
/*     */   public static final int PKVALUE = 16;
/*     */   public static final int REPUTATION = 32;
/*     */   public static final int POTENTIAL = 64;
/*     */   public static final int OCCUPATION = 128;
/*     */   public static final int CLEARINVENTORY = 256;
/*  31 */   public static final Object locker = new Object();
/*  32 */   public static ClientManager mgr = ClientManager.GetInstance();
/*     */ 
/*     */   public static void init()
/*     */     throws InterruptedException
/*     */   {
/*     */   }
/*     */ 
/*     */   public static QueryUseridRes getUseridByName(String rolename)
/*     */     throws Exception
/*     */   {
/*  49 */     init();
/*  50 */     if (null == mgr.s)
/*  51 */       return null;
/*  52 */     QueryUseridArg arg = new QueryUseridArg();
/*  53 */     arg.rolename.setString(rolename);
/*     */ 
/*  55 */     QueryUserid rpc = (QueryUserid)Rpc.Call("QueryUserid", arg);
/*  56 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(getUseridByName)");
/*  57 */     PollIO.WakeUp();
/*  58 */     synchronized (rpc) { rpc.wait(); }
/*  59 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getUseridByName)");
/*  60 */     return rpc.queryUseridRes;
/*     */   }
/*     */ 
/*     */   public static int getRoleIdByName(String rolename) throws Exception {
/*  64 */     init();
/*  65 */     if (null == mgr.s)
/*  66 */       return -1;
/*  67 */     GetRoleIdArg arg = new GetRoleIdArg();
/*  68 */     arg.rolename.setString(rolename);
/*     */ 
/*  70 */     GetRoleId rpc = (GetRoleId)Rpc.Call("GetRoleId", arg);
/*  71 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(getRoleIdByName)");
/*  72 */     PollIO.WakeUp();
/*  73 */     synchronized (rpc) { rpc.wait(); }
/*  74 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleIdByName)");
/*  75 */     return rpc.roleid;
/*     */   }
/*     */ 
/*     */   public static Rpc.Data.DataVector getRolelist(int userid) throws Exception
/*     */   {
/*  80 */     init();
/*  81 */     if (null == mgr.s)
/*  82 */       return null;
/*  83 */     GetUserRolesArg arg = new GetUserRolesArg();
/*  84 */     arg.userid = userid;
/*     */ 
/*  86 */     GetUserRoles rpc = (GetUserRoles)Rpc.Call("GetUserRoles", arg);
/*  87 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(getRolelist)");
/*  88 */     PollIO.WakeUp();
/*  89 */     synchronized (rpc) { rpc.wait(); }
/*  90 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleList)");
/*  91 */     if ((0 != rpc.retcode) || (rpc.userid == -1))
/*  92 */       return null;
/*  93 */     return rpc.roles;
/*     */   }
/*     */ 
/*     */   public static int clearStorehousePasswd(int roleid, String rolename) throws Exception
/*     */   {
/*  98 */     init();
/*  99 */     if (null == mgr.s) {
/* 100 */       return -1;
/*     */     }
/* 102 */     ClearStorehousePasswdArg arg = new ClearStorehousePasswdArg();
/* 103 */     arg.roleid = roleid;
/* 104 */     arg.rolename.setString(rolename);
/*     */ 
/* 106 */     ClearStorehousePasswd rpc = (ClearStorehousePasswd)Rpc.Call("ClearStorehousePasswd", arg);
/* 107 */     if (!mgr.Send(mgr.s, rpc)) return -1;
/* 108 */     PollIO.WakeUp();
/* 109 */     synchronized (rpc) { rpc.wait(); }
/* 110 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int canChangeRolename(String rolename, int setcanchange) throws Exception
/*     */   {
/* 115 */     init();
/* 116 */     if (null == mgr.s)
/* 117 */       return -1;
/* 118 */     CanChangeRolenameArg arg = new CanChangeRolenameArg();
/* 119 */     arg.rolename.setString(rolename);
/* 120 */     arg.setcanchange = setcanchange;
/*     */ 
/* 122 */     CanChangeRolename rpc = (CanChangeRolename)Rpc.Call("CanChangeRolename", arg);
/* 123 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(canChangeRolename)");
/* 124 */     PollIO.WakeUp();
/* 125 */     synchronized (rpc) { rpc.wait(); }
/* 126 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(canChangeRolename)");
/* 127 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int renameRole(int roleid, String oldname, String newname) throws Exception
/*     */   {
/* 132 */     init();
/* 133 */     if (null == mgr.s) {
/* 134 */       return -1;
/*     */     }
/* 136 */     RenameRoleArg arg = new RenameRoleArg();
/* 137 */     arg.roleid = roleid;
/* 138 */     arg.oldname.setString(oldname);
/* 139 */     arg.newname.setString(newname);
/*     */ 
/* 141 */     RenameRole rpc = (RenameRole)Rpc.Call("RenameRole", arg);
/* 142 */     if (!mgr.Send(mgr.s, rpc)) return -1;
/* 143 */     PollIO.WakeUp();
/* 144 */     synchronized (rpc) { rpc.wait(); }
/* 145 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int Uid2Logicuid(int userid) throws InterruptedException, Exception
/*     */   {
/* 150 */     init();
/* 151 */     if (null == mgr.s) {
/* 152 */       return -1;
/*     */     }
/* 154 */     Uid2LogicuidArg arg = new Uid2LogicuidArg();
/* 155 */     arg.userid = userid;
/*     */ 
/* 157 */     Uid2Logicuid rpc = (Uid2Logicuid)Rpc.Call("Uid2Logicuid", arg);
/* 158 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(Uid2Logicuid)");
/* 159 */     PollIO.WakeUp();
/* 160 */     synchronized (rpc) { rpc.wait(); }
/* 161 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(Uid2Logicuid)");
/* 162 */     if (0 == rpc.retcode)
/* 163 */       return rpc.logicuid;
/* 164 */     return -1;
/*     */   }
/*     */ 
/*     */   public static int Roleid2Uid(int roleid) throws InterruptedException, Exception
/*     */   {
/* 169 */     init();
/* 170 */     if (null == mgr.s) {
/* 171 */       return -1;
/*     */     }
/* 173 */     Roleid2UidArg arg = new Roleid2UidArg();
/* 174 */     arg.roleid = roleid;
/*     */ 
/* 176 */     Roleid2Uid rpc = (Roleid2Uid)Rpc.Call("Roleid2Uid", arg);
/* 177 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(Roleid2Uid)");
/* 178 */     PollIO.WakeUp();
/* 179 */     synchronized (rpc) { rpc.wait(); }
/* 180 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(Roleid2Uid)");
/* 181 */     if (0 == rpc.retcode)
/* 182 */       return rpc.userid;
/* 183 */     return -1;
/*     */   }
/*     */ 
/*     */   public static int DBVerifyMaster(String rolename, String factionname) throws Exception
/*     */   {
/* 188 */     init();
/* 189 */     if (null == mgr.s)
/* 190 */       return -1;
/* 191 */     DBVerifyMasterArg arg = new DBVerifyMasterArg();
/* 192 */     arg.name.setString(rolename);
/* 193 */     arg.faction.setString(factionname);
/*     */ 
/* 195 */     DBVerifyMaster rpc = (DBVerifyMaster)Rpc.Call("DBVerifyMaster", arg);
/* 196 */     if (!mgr.Send(mgr.s, rpc)) return -1;
/* 197 */     PollIO.WakeUp();
/* 198 */     synchronized (rpc) { rpc.wait(); }
/* 199 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int createRole(int userid, int logicuid, int roleid, XmlRole.Role role) throws InterruptedException, Exception
/*     */   {
/* 204 */     init();
/* 205 */     if (null == mgr.s) {
/* 206 */       return -1;
/*     */     }
/* 208 */     DBCreateRoleArg arg = new DBCreateRoleArg();
/* 209 */     arg.userid = userid;
/* 210 */     arg.logicuid = logicuid;
/* 211 */     arg.roleid = roleid;
/*     */ 
/* 213 */     arg.roleinfo.roleid = roleid;
/* 214 */     arg.roleinfo.gender = role.base.gender;
/* 215 */     arg.roleinfo.race = ((byte)role.base.race);
/* 216 */     arg.roleinfo.occupation = ((byte)role.base.cls);
/* 217 */     arg.roleinfo.level = role.status.level;
/* 218 */     arg.roleinfo.name = role.base.name;
/*     */ 
/* 220 */     DBCreateRole rpc = (DBCreateRole)Rpc.Call("DBCreateRole", arg);
/* 221 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(createRole)");
/* 222 */     PollIO.WakeUp();
/* 223 */     synchronized (rpc) { rpc.wait(); }
/* 224 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(createRole)");
/* 225 */     if (0 == rpc.retcode)
/*     */     {
/* 227 */       return rpc.roleid;
/*     */     }
/* 229 */     return rpc.retcode > 0 ? -rpc.retcode : rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static boolean deleteRolePermanent(int roleid) throws InterruptedException, Exception
/*     */   {
/* 234 */     init();
/* 235 */     if (null == mgr.s) {
/* 236 */       return false;
/*     */     }
/* 238 */     DBDeleteRoleArg arg = new DBDeleteRoleArg();
/* 239 */     arg.roleid = roleid;
/*     */ 
/* 241 */     DBDeleteRole rpc = (DBDeleteRole)Rpc.Call("DBDeleteRole", arg);
/* 242 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(deleteRolePermanent)");
/* 243 */     PollIO.WakeUp();
/* 244 */     synchronized (rpc) { rpc.wait(); }
/* 245 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(deleteRolePermanent)");
/* 246 */     return 0 == rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static boolean moveRole(int roleid, int newuserid) throws InterruptedException, Exception
/*     */   {
/* 251 */     return false;
/*     */   }
/*     */ 
/*     */   public static User getUser(int userid)
/*     */     throws Exception
/*     */   {
/* 283 */     init();
/* 284 */     if (null == mgr.s)
/* 285 */       return null;
/* 286 */     UserArg arg = new UserArg();
/* 287 */     arg.id = userid;
/*     */ 
/* 289 */     GetUser rpc = (GetUser)Rpc.Call("GetUser", arg);
/* 290 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(getUser)");
/* 291 */     PollIO.WakeUp();
/* 292 */     synchronized (rpc) { rpc.wait(); }
/* 293 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getUser)");
/* 294 */     if (0 != rpc.retcode)
/* 295 */       return null;
/* 296 */     return rpc.user;
/*     */   }
/*     */ 
/*     */   public static boolean putUser(int userid, User user) throws InterruptedException, Exception {
/* 300 */     init();
/* 301 */     if (null == mgr.s) {
/* 302 */       return false;
/*     */     }
/* 304 */     if (null == user) return false;
/*     */ 
/* 306 */     UserPair arg = new UserPair();
/* 307 */     arg.key.id = userid;
/* 308 */     arg.value = user;
/*     */ 
/* 310 */     PutUser rpc = (PutUser)Rpc.Call("PutUser", arg);
/* 311 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(putUser)");
/* 312 */     PollIO.WakeUp();
/* 313 */     synchronized (rpc) { rpc.wait(); }
/* 314 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(putUser)");
/* 315 */     return 0 == rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static GRoleBase getRoleBase(int roleid) throws InterruptedException, Exception
/*     */   {
/* 320 */     init();
/* 321 */     if (null == mgr.s) {
/* 322 */       return null;
/*     */     }
/* 324 */     RoleId arg = new RoleId();
/* 325 */     arg.id = roleid;
/*     */ 
/* 327 */     GetRoleBase rpc = (GetRoleBase)Rpc.Call("GetRoleBase", arg);
/* 328 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(putRoleBase)");
/* 329 */     PollIO.WakeUp();
/* 330 */     synchronized (rpc) { rpc.wait(); }
/* 331 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleBase)");
/* 332 */     return rpc.base;
/*     */   }
/*     */ 
/*     */   public static GRoleStatus getRoleStatus(int roleid) throws InterruptedException, Exception
/*     */   {
/* 337 */     init();
/* 338 */     if (null == mgr.s) {
/* 339 */       return null;
/*     */     }
/* 341 */     RoleId arg = new RoleId();
/* 342 */     arg.id = roleid;
/*     */ 
/* 344 */     GetRoleStatus rpc = (GetRoleStatus)Rpc.Call("GetRoleStatus", arg);
/* 345 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(getRoleStatus)");
/* 346 */     PollIO.WakeUp();
/* 347 */     synchronized (rpc) { rpc.wait(); }
/* 348 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleStatus)");
/* 349 */     return rpc.status;
/*     */   }
/*     */ 
/*     */   public static GRolePocket getRolePocket(int roleid) throws InterruptedException, Exception
/*     */   {
/* 354 */     init();
/* 355 */     if (null == mgr.s) {
/* 356 */       return null;
/*     */     }
/* 358 */     RoleId arg = new RoleId();
/* 359 */     arg.id = roleid;
/*     */ 
/* 361 */     GetRolePocket rpc = (GetRolePocket)Rpc.Call("GetRolePocket", arg);
/* 362 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(getRolePocket)");
/* 363 */     PollIO.WakeUp();
/* 364 */     synchronized (rpc) { rpc.wait(); }
/* 365 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRolePocket)");
/* 366 */     return rpc.pocket;
/*     */   }
/*     */ 
/*     */   public static Rpc.Data.DataVector getRoleEquipment(int roleid) throws InterruptedException, Exception
/*     */   {
/* 371 */     init();
/* 372 */     if (null == mgr.s) {
/* 373 */       return null;
/*     */     }
/* 375 */     RoleId arg = new RoleId();
/* 376 */     arg.id = roleid;
/*     */ 
/* 378 */     GetRoleEquipment rpc = (GetRoleEquipment)Rpc.Call("GetRoleEquipment", arg);
/* 379 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(getRoleEquipment)");
/* 380 */     PollIO.WakeUp();
/* 381 */     synchronized (rpc) { rpc.wait(); }
/* 382 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleEquipment)");
/* 383 */     return rpc.equipment;
/*     */   }
/*     */ 
/*     */   public static GRoleStorehouse getRoleStorehouse(int roleid) throws InterruptedException, Exception
/*     */   {
/* 388 */     init();
/* 389 */     if (null == mgr.s) {
/* 390 */       return null;
/*     */     }
/* 392 */     RoleId arg = new RoleId();
/* 393 */     arg.id = roleid;
/*     */ 
/* 395 */     GetRoleStorehouse rpc = (GetRoleStorehouse)Rpc.Call("GetRoleStorehouse", arg);
/* 396 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(putRoleStorehouse)");
/* 397 */     PollIO.WakeUp();
/* 398 */     synchronized (rpc) { rpc.wait(); }
/* 399 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleStorehouse)");
/* 400 */     return rpc.storehouse;
/*     */   }
/*     */ 
/*     */   public static GRoleTask getRoleTask(int roleid) throws InterruptedException, Exception
/*     */   {
/* 405 */     init();
/* 406 */     if (null == mgr.s) {
/* 407 */       return null;
/*     */     }
/* 409 */     RoleId arg = new RoleId();
/* 410 */     arg.id = roleid;
/*     */ 
/* 412 */     GetRoleTask rpc = (GetRoleTask)Rpc.Call("GetRoleTask", arg);
/* 413 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(putRoleTask)");
/* 414 */     PollIO.WakeUp();
/* 415 */     synchronized (rpc) { rpc.wait(); }
/* 416 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleTask)");
/* 417 */     return rpc.task;
/*     */   }
/*     */ 
/*     */   public static GRoleData getRoleData(int roleid) throws InterruptedException, Exception
/*     */   {
/* 422 */     init();
/* 423 */     if (null == mgr.s) return null;
/* 424 */     RoleId arg = new RoleId();
/* 425 */     arg.id = roleid;
/*     */ 
/* 427 */     GetRoleData rpc = (GetRoleData)Rpc.Call("GetRoleData", arg);
/* 428 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(GetRoleData)");
/* 429 */     PollIO.WakeUp();
/* 430 */     synchronized (rpc) { rpc.wait(); }
/* 431 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(getRoleData)");
/* 432 */     return rpc.value;
/*     */   }
/*     */ 
/*     */   public static boolean putRoleData(int roleid, GRoleData data) throws InterruptedException, Exception
/*     */   {
/* 437 */     init();
/* 438 */     if (null == mgr.s) return false;
/* 439 */     if (null == data) return false;
/* 440 */     RoleDataPair arg = new RoleDataPair();
/* 441 */     arg.key.id = roleid;
/* 442 */     arg.overwrite = 1;
/* 443 */     arg.value = data;
/*     */ 
/* 445 */     PutRoleData rpc = (PutRoleData)Rpc.Call("PutRoleData", arg);
/* 446 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(putRoleData)");
/* 447 */     PollIO.WakeUp();
/* 448 */     synchronized (rpc) { rpc.wait(); }
/* 449 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(putRoleData)");
/* 450 */     return 0 == rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static RoleBean get(int roleid)
/*     */     throws InterruptedException, Exception
/*     */   {
/* 474 */     RoleBean bean = new RoleBean();
/* 475 */     bean.user = getUser(Roleid2Uid(roleid));
/* 476 */     if (null == bean.user) return null;
/*     */ 
/* 478 */     GRoleData roledata = getRoleData(roleid);
/* 479 */     if (null == roledata) return null;
/* 480 */     bean.base = roledata.base;
/* 481 */     bean.SetGRoleStatus(roledata.status);
/* 482 */     bean.pocket = roledata.pocket;
/* 483 */     bean.storehouse = roledata.storehouse;
/* 484 */     bean.task = roledata.task;
/* 485 */     bean.equipment = roledata.equipment.inv;
/*     */ 
/* 487 */     if (null == bean.pocket) bean.pocket = new GRolePocket();
/* 488 */     if (null == bean.equipment) bean.equipment = new Rpc.Data.DataVector(new GRoleInventory());
/* 489 */     if (null == bean.storehouse) bean.storehouse = new GRoleStorehouse();
/* 490 */     if (null == bean.task) bean.task = new GRoleTask();
/* 491 */     if ((null == bean.user) || (null == bean.base) || (null == bean.status))
/* 492 */       return null;
/* 493 */     return bean;
/*     */   }
/*     */ 
/*     */   public static boolean update(RoleBean bean)
/*     */     throws InterruptedException, Exception
/*     */   {
/* 516 */     GRoleData roledata = new GRoleData();
/* 517 */     roledata.equipment.inv = bean.equipment;
/* 518 */     roledata.base = bean.base;
/* 519 */     roledata.status = bean.GetGRoleStatus();
/* 520 */     roledata.pocket = bean.pocket;
/* 521 */     roledata.storehouse = bean.storehouse;
/* 522 */     roledata.task = bean.task;
/* 523 */     return putRoleData(bean.base.id, roledata);
/*     */   }
/*     */ 
/*     */   public static int modifyRoleLevel(int roleid, int level) throws InterruptedException, Exception
/*     */   {
/* 528 */     init();
/* 529 */     if (null == mgr.s) return -1;
/* 530 */     if (0 == level) return -1;
/* 531 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 532 */     arg.roleid = roleid;
/* 533 */     arg.mask |= 1;
/* 534 */     arg.level = level;
/*     */ 
/* 537 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 538 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 539 */     PollIO.WakeUp();
/* 540 */     synchronized (rpc) { rpc.wait(); }
/* 541 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 542 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRoleExp(int roleid, long exp) throws InterruptedException, Exception
/*     */   {
/* 547 */     init();
/* 548 */     if (null == mgr.s) return -1;
/* 549 */     if (0L == exp) return -1;
/* 550 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 551 */     arg.roleid = roleid;
/* 552 */     arg.mask |= 2;
/* 553 */     arg.exp = exp;
/*     */ 
/* 556 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 557 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 558 */     PollIO.WakeUp();
/* 559 */     synchronized (rpc) { rpc.wait(); }
/* 560 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 561 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRolePocketMoney(int roleid, int pocketmoney) throws InterruptedException, Exception
/*     */   {
/* 566 */     init();
/* 567 */     if (null == mgr.s) return -1;
/* 568 */     if (0 == pocketmoney) return -1;
/* 569 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 570 */     arg.roleid = roleid;
/* 571 */     arg.mask |= 4;
/* 572 */     arg.pocket_money = pocketmoney;
/*     */ 
/* 575 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 576 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 577 */     PollIO.WakeUp();
/* 578 */     synchronized (rpc) { rpc.wait(); }
/* 579 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 580 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRoleStoreMoney(int roleid, int storemoney) throws InterruptedException, Exception
/*     */   {
/* 585 */     init();
/* 586 */     if (null == mgr.s) return -1;
/* 587 */     if (0 == storemoney) return -1;
/* 588 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 589 */     arg.roleid = roleid;
/* 590 */     arg.mask |= 8;
/* 591 */     arg.store_money = storemoney;
/*     */ 
/* 594 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 595 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 596 */     PollIO.WakeUp();
/* 597 */     synchronized (rpc) { rpc.wait(); }
/* 598 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 599 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRolePkvalue(int roleid, int pkvalue) throws InterruptedException, Exception
/*     */   {
/* 604 */     init();
/* 605 */     if (null == mgr.s) return -1;
/* 606 */     if (0 == pkvalue) return -1;
/* 607 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 608 */     arg.roleid = roleid;
/* 609 */     arg.mask |= 16;
/* 610 */     arg.pkvalue = pkvalue;
/*     */ 
/* 613 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 614 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 615 */     PollIO.WakeUp();
/* 616 */     synchronized (rpc) { rpc.wait(); }
/* 617 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 618 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRoleReputation(int roleid, int reputation) throws InterruptedException, Exception
/*     */   {
/* 623 */     init();
/* 624 */     if (null == mgr.s) return -1;
/* 625 */     if (0 == reputation) return -1;
/* 626 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 627 */     arg.roleid = roleid;
/* 628 */     arg.mask |= 32;
/* 629 */     arg.reputation = reputation;
/*     */ 
/* 632 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 633 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 634 */     PollIO.WakeUp();
/* 635 */     synchronized (rpc) { rpc.wait(); }
/* 636 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 637 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRolePotential(int roleid, int potential) throws InterruptedException, Exception
/*     */   {
/* 642 */     init();
/* 643 */     if (null == mgr.s) return -1;
/* 644 */     if (0 == potential) return -1;
/* 645 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 646 */     arg.roleid = roleid;
/* 647 */     arg.mask |= 64;
/* 648 */     arg.potential = potential;
/*     */ 
/* 651 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 652 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 653 */     PollIO.WakeUp();
/* 654 */     synchronized (rpc) { rpc.wait(); }
/* 655 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 656 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRoleAllMoney(int roleid, int pocket_money, int store_money) throws InterruptedException, Exception
/*     */   {
/* 661 */     init();
/* 662 */     if (null == mgr.s) return -1;
/* 663 */     if (0 == pocket_money) return -1;
/* 664 */     if (0 == store_money) return -1;
/* 665 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 666 */     arg.roleid = roleid;
/* 667 */     arg.mask |= 8;
/* 668 */     arg.mask |= 4;
/* 669 */     arg.pocket_money = pocket_money;
/* 670 */     arg.store_money = store_money;
/*     */ 
/* 673 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 674 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 675 */     PollIO.WakeUp();
/* 676 */     synchronized (rpc) { rpc.wait(); }
/* 677 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 678 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static int modifyRoleOccupation(int roleid, int occupation) throws InterruptedException, Exception
/*     */   {
/* 683 */     init();
/* 684 */     if (null == mgr.s) return -1;
/* 685 */     if (0 == occupation) return -1;
/* 686 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 687 */     arg.roleid = roleid;
/* 688 */     arg.mask |= 128;
/* 689 */     arg.occupation = occupation;
/*     */ 
/* 692 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 693 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 694 */     PollIO.WakeUp();
/* 695 */     synchronized (rpc) { rpc.wait(); }
/* 696 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 697 */     return rpc.retcode;
/*     */   }
/*     */ 
/*     */   public static long modifyRoleClearAllMoney(int roleid) throws InterruptedException, Exception
/*     */   {
/* 702 */     init();
/* 703 */     if (null == mgr.s) return -1L;
/* 704 */     DBModifyRoleDataArg arg = new DBModifyRoleDataArg();
/* 705 */     arg.roleid = roleid;
/* 706 */     arg.mask |= 256;
/*     */ 
/* 708 */     DBModifyRoleData rpc = (DBModifyRoleData)Rpc.Call("DBModifyRoleData", arg);
/* 709 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络连接未建立。(DBModifyRoleData)");
/* 710 */     PollIO.WakeUp();
/* 711 */     synchronized (rpc) { rpc.wait(); }
/* 712 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时。(DBModifyRoleData)");
/* 713 */     System.out.println("modifyRoleClearAllMoney roleid=" + roleid + " retcode=" + rpc.retcode);
/* 714 */     return 0 == rpc.retcode ? rpc.datares.total_money : -1L;
/*     */   }
/*     */ 
/*     */   public static GRoleForbid DlyForbidUser(int operation, int userid, int time, String reason) throws Exception {
/* 718 */     init();
/* 719 */     if (null == mgr.s)
/* 720 */       return null;
/* 721 */     ForbidUserArg arg = new ForbidUserArg();
/* 722 */     arg.operation = ((byte)operation);
/* 723 */     arg.userid = userid;
/* 724 */     arg.time = time;
/* 725 */     arg.reason.setString(reason);
/* 726 */     ForbidUser rpc = (ForbidUser)Rpc.Call("ForbidUser", arg);
/* 727 */     if (!mgr.Send(mgr.s, rpc)) throw new Exception("网络链接未建立.(ForbidUser");
/* 728 */     PollIO.WakeUp();
/* 729 */     synchronized (rpc) { rpc.wait(); }
/* 730 */     if (4 == rpc.retcode) throw new Exception("网络通讯超时.(ForbidUser)");
/* 731 */     return 0 == rpc.retcode ? rpc.groleforbid : null;
/*     */   }
/*     */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GameDB
 * JD-Core Version:    0.6.2
 */