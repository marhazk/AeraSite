/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class DBModifyRoleDataArg extends Rpc.Data
/*    */ {
/*    */   public int roleid;
/*    */   public int mask;
/*    */   public int level;
/*    */   public long exp;
/*    */   public int pocket_money;
/*    */   public int store_money;
/*    */   public int pkvalue;
/*    */   public int reputation;
/*    */   public int potential;
/*    */   public int occupation;
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 27 */     os.marshal(this.roleid);
/* 28 */     os.marshal(this.mask);
/* 29 */     os.marshal(this.level);
/* 30 */     os.marshal(this.exp);
/* 31 */     os.marshal(this.pocket_money);
/* 32 */     os.marshal(this.store_money);
/* 33 */     os.marshal(this.pkvalue);
/* 34 */     os.marshal(this.reputation);
/* 35 */     os.marshal(this.potential);
/* 36 */     os.marshal(this.occupation);
/* 37 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 42 */     this.roleid = os.unmarshal_int();
/* 43 */     this.mask = os.unmarshal_int();
/* 44 */     this.level = os.unmarshal_int();
/* 45 */     this.exp = os.unmarshal_long();
/* 46 */     this.pocket_money = os.unmarshal_int();
/* 47 */     this.store_money = os.unmarshal_int();
/* 48 */     this.pkvalue = os.unmarshal_int();
/* 49 */     this.reputation = os.unmarshal_int();
/* 50 */     this.potential = os.unmarshal_int();
/* 51 */     this.occupation = os.unmarshal_int();
/* 52 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 59 */       return (DBModifyRoleDataArg)super.clone();
/*    */     }
/*    */     catch (Exception e) {
/*    */     }
/* 63 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.DBModifyRoleDataArg
 * JD-Core Version:    0.6.2
 */