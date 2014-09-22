/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Rpc.Data;
/*    */ 
/*    */ public final class GRoleInventory extends Rpc.Data
/*    */ {
/*    */   public int id;
/*    */   public int pos;
/*    */   public int count;
/*    */   public int max_count;
/*    */   public Octets data;
/*    */   public int proctype;
/*    */   public int expire_date;
/*    */   public int guid1;
/*    */   public int guid2;
/*    */   public int mask;
/*    */ 
/*    */   public GRoleInventory()
/*    */   {
/* 23 */     this.data = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 28 */     os.marshal(this.id);
/* 29 */     os.marshal(this.pos);
/* 30 */     os.marshal(this.count);
/* 31 */     os.marshal(this.max_count);
/* 32 */     os.marshal(this.data);
/* 33 */     os.marshal(this.proctype);
/* 34 */     os.marshal(this.expire_date);
/* 35 */     os.marshal(this.guid1);
/* 36 */     os.marshal(this.guid2);
/* 37 */     os.marshal(this.mask);
/* 38 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 43 */     this.id = os.unmarshal_int();
/* 44 */     this.pos = os.unmarshal_int();
/* 45 */     this.count = os.unmarshal_int();
/* 46 */     this.max_count = os.unmarshal_int();
/* 47 */     os.unmarshal(this.data);
/* 48 */     this.proctype = os.unmarshal_int();
/* 49 */     this.expire_date = os.unmarshal_int();
/* 50 */     this.guid1 = os.unmarshal_int();
/* 51 */     this.guid2 = os.unmarshal_int();
/* 52 */     this.mask = os.unmarshal_int();
/* 53 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 60 */       GRoleInventory o = (GRoleInventory)super.clone();
/* 61 */       o.data = ((Octets)this.data.clone());
/* 62 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 65 */     return null;
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GRoleInventory
 * JD-Core Version:    0.6.2
 */